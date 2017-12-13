<?php
/**
 * ACF Codifier
 */
namespace Geniem\ACF;

/**
 * ACF Codifier
 */
class Codifier {
    /**
     * ACF field labels to be hidden on the admin side
     *
     * @var array
     */
    protected static $hidden_labels = [];

    /**
     * This is used with WP object caching.
     * We use ACF's cache group for now.
     *
     * This is overridable with the 'ACF_CODIFIER_CACHE_GROUP' constant.
     *
     * @var string
     */
    public static $cache_group = 'acf';

    /**
     * This ttl is used when objects are not eternally cached.
     *
     * This is overridable with the 'ACF_CODIFIER_CACHE_TTL' constant.
     *
     * @var float|int
     */
    public static $cache_ttl = 15 * MINUTE_IN_SECONDS;

    /**
     * Initialize the plugin by adding hooks.
     *
     * @return void
     */
    public static function init() {

        self::override_settings();

        add_action( 'admin_head', __CLASS__ . '::hide_labels' );

        // Cache control.
        add_action( 'updated_postmeta', [ __CLASS__, 'flush_post_meta_caches' ], 1, 1 );
        add_filter( 'acf/update_value',  [ __CLASS__, 'flush_formatted_value' ], 10, 3 );

    }

    /**
     * This function overrides class settings with defined constants.
     */
    public static function override_settings(  ) {

        if ( defined( 'ACF_CODIFIER_CACHE_GROUP' ) ) {
            self::$cache_group = ACF_CODIFIER_CACHE_GROUP;
        }

        if ( defined( 'ACF_CODIFIER_CACHE_TTL' ) ) {
            self::$cache_group = ACF_CODIFIER_CACHE_TTL;
        }

    }

    /**
     * Hide ACF field labels from desired fields
     *
     * @return void
     */
    public static function hide_labels() {
        if ( ! empty( self::$hidden_labels ) && is_array( self::$hidden_labels ) ) {

            echo "<style>\n";
            foreach ( self::$hidden_labels as $field ) {
                if ( is_string( $field ) ) {
                    $key = $field;
                }
                else {
                    $key = $field->get_key();
                }

                $key = str_replace( '_', '-', $key );

                echo 'div.acf-field.acf-field-' . $key . " label { display: none; }\n";
            }

            echo "</style>\n";
        }
    }

    /**
     * Hides an ACF field label
     *
     * @param mixed $field Either a field object or field's key.
     * @return void
     */
    public static function hide_label( $field ) {
        if ( is_string( $field ) ) {
            $key = $field;
        }
        else {
            $key = $field->get_key();
        }

        self::$hidden_labels[ $key ] = $field;
    }

    /**
     * Shows a previously hidden ACF field label
     *
     * @param mixed $field Either a field object or field's key.
     * @return void
     */
    public static function show_field( $field ) {
        if ( is_string( $field ) ) {
            $key = $field;
        }
        else {
            $key = $field->get_key();
        }

        unset( self::$hidden_labels[ $key ] );
    }

    /**
     * Returns true or false if an ACF field's label has been hidden
     *
     * @param mixed $field Either a field object or field's key.
     * @return boolean
     */
    public static function get_label_visibility( $field ) {
        if ( is_string( $field ) ) {
            $key = $field;
        }
        else {
            $key = $field->get_key();
        }

        return isset( self::$hidden_labels[ $key ] );
    }

    /**
     * A more efficient replacement for ACF's native get_fields function
     *
     * @param int $id       Post id to fetch fields from
     * @param array $wanted Keys for wanted fields. Empty or null default to all
     * @return array Fields as an associative array
     */
    public static function get_fields( $id, $wanted = null ) {
        global $wpdb;

        // Get the raw meta data from the database
        $rows = get_post_meta( $id );

        // Filter only the keys we want
        if ( ! empty( $wanted ) ) {
            $rows = array_filter( $rows, function( $key ) {
                // Strip possible trailing underscore
                if ( substr( $key, 0, 1 ) === '_' ) {
                    $key = substr( $key, 1 );
                }

                return in_array( $key, $wanted );
            }, ARRAY_FILTER_USE_KEY );
        }

        // Sort the meta rows so that the ones deeper in the final data tree come last
        // Return the sorted data from the cache if it's stored there
        $sorted = wp_cache_get( 'sorted_meta_data/' . $id, self::$cache_group );

        if ( ! $sorted ) {
            $sort_cache = [];

            uksort( $rows, function ( $a, $b ) {
                // Check if $a parse value is in cache
                if ( isset( $sort_cache[ $a ] ) ) {
                    $a_amount = $sort_cache[ $a ];
                }
                else {
                    // Find the depth from key
                    preg_match_all( '/_(\d+)_/', $a, $a_amount );
                    $a_amount = count( $a_amount[0] );
                }

                // Check if $b parse value is in cache
                if ( isset( $sort_cache[ $b ] ) ) {
                    $b_amount = $sort_cache[ $b ];
                }
                else {
                    // Find the depth from key
                    preg_match_all( '/_(\d+)_/', $b, $b_amount );
                    $b_amount = count( $b_amount[0] );
                }

                // If the depth is same, sort alphabetically
                if ( $a_amount === $b_amount ) {
                    return $a <=> $b;
                }
                else {
                    return $a_amount <=> $b_amount;
                }
            } );
            // Store the sorted data to the cache because this is a relatively heavy operation
            wp_cache_set( 'sorted_meta_data/' . $id, $rows, self::$cache_group );
        }
        else {
            $rows = $sorted;
        }

        $original = [];

        // Convert the data from get_postmeta to one-dimensional key-value format for easiness
        foreach ( $rows as $key => $row ) {
            $original[ $key ] = $row[0];
        }

        // Initiate a few arrays for the future
        $times          = [];
        $fields         = [];
        $clones         = [];
        $layouts        = [];
        $layout_filters = [];

        // Loop through all meta values
        foreach ( $original as $key => $value ) {

            // We don't want to handle meta-meta values for now
            if ( $key[0] === '_' ) {
                continue;
            }

            // If a field doesn't have a meta-meta pair, we don't want to include it
            if ( ! isset( $original[ '_' . $key ] ) ) {
                continue;
            }

            // Fetch the appropriate field object
            $field_key = $original[ '_' . $key ];

            // Check if we have a field declaration stored in cache
            $field = wp_cache_get( 'get_field_object=' . $field_key, self::$cache_group );

            if ( ! $field ) {
                $field = acf_get_local_field( $field_key );

                // If there is a meta-meta pair but the field doesn't exist anymore,
                // continue without returning the data
                if ( ! $field ) {
                    continue;
                }

                // ACF needs this for some reason
                $field['_name'] = $field['name'];

                // Store the field declaration to cache
                wp_cache_set( 'get_field_object=' . $field_key, $field, self::$cache_group );
            }

            // If there have been cloned fields, we need to run a few checks
            if ( ! empty( $clones ) ) {
                foreach ( $clones as $clone_key => $clone_value ) {
                    // The clone's key would be first in the actual key
                    $clone_key_array = explode( '_', $clone_key );
                    $clone_key       = $clone_key_array[0];

                    // Does the key start with a known clone key?
                    if ( substr( $key, 0, strlen( $clone_key . '_' ) ) === $clone_key . '_' ) {
                        $initial_path = [ $clone_key ];
                        $path_key     = substr( $key, strlen( $clone_key . '_' ) );
                    }
                    else {
                        $path_key     = $key;
                        $initial_path = [];
                    }
                }
            }
            else {
                $path_key     = $key;
                $initial_path = [];
            }

            // Split the key for positioning the values in the tree
            $path = preg_split( '/_(\d+)_/', $path_key, 0, PREG_SPLIT_DELIM_CAPTURE );

            $path = array_merge( $initial_path, $path );

            // Create a reference to the spot where the value is supposed to be placed
            $value_node =& $fields;

            // Reference magic: find the appropriate location for the value to be stored
            foreach ( $path as $pkey ) {
                $value_node =& $value_node[ $pkey ];
            }

            /**
             * Filters the cache group key before field handling.
             *
             * Use this to set specific group keys for different post types for instance.
             *
             * @since 1.2.0
             *
             * @param string $cache_group The default group key.
             * @param int    $id          The post id.
             * @param string $key         The ACF field key.
             */
            $cache_group = apply_filters( 'acf_codifier_cache_key', self::$cache_group, $id, $field['key'] );

            // Do field type specific things
            switch ( $field['type'] ) {
                case 'clone':
                    // Get the cloned field's field object either from cache or from the declaration
                    $field_object = wp_cache_get( 'get_field_object/' . $field['key'], $cache_group );
                    if ( ! $field_object ) {
                        $field_object = acf_get_local_field( $field['key'] );
                        wp_cache_set( 'get_field_object/' . $field['key'], $field_object, $cache_group );
                    }

                    // Loop through cloned fields and fetch their field objects
                    // either from cache or from the declaration
                    foreach ( $field_object['clone'] as $cloned_fields ) {
                        $cloned_field = wp_cache_get( 'get_field_object/' . $cloned_fields, $cache_group );
                        if ( ! $cloned_field ) {
                            $cloned_field = acf_get_local_field( $cloned_fields );
                            wp_cache_set( 'get_field_object/' . $cloned_fields, $cloned_field, $cache_group );
                        }

                        // Store the objects for future use
                        $clones[ $key . '_' . $cloned_field['name'] ] = $cloned_field;
                    }

                    // Create an empty node in the tree to store the actual values later
                    $value_node = [];
                    break;
                case 'flexible_content':
                    // Flexible content field's value is an array of the layouts used
                    $layouts = maybe_unserialize( $value );

                    // Create an empty node in the tree to store the actual values
                    $value_node = [];

                    // Loop through the layouts
                    foreach ( $layouts as $index => $layout ) {
                        // Insert the layout name in the data
                        $value_node[ $index ] = [ 'acf_fc_layout' => $layout ];

                        // Initialize the layout's node if it isn't already there
                        if ( ! isset( $layout_filters[ $layout ] ) ) {
                            $layout_filters[ $layout ] = [];
                        }
                        // Store a reference to the layout node for DustPress Component filtering
                        $layout_filters[ $layout ][] =& $value_node[ $index ];
                    }
                    break;
                case 'repeater':
                    // Create an empty node in the tree to store the actual values later
                    $value_node = [];
                    break;
                default:
                    $value_node = wp_cache_get( 'get_field/formatted/' . $id . '/' . $key, $cache_group );

                    if ( ! $value_node ) {

                        // Run the value through a bunch of ACF filters to get the format we want
                        $value = maybe_unserialize( $value );
                        $value = apply_filters( "acf/format_value", $value, $id, $field );
                        $value = apply_filters( "acf/format_value/type={$field['type']}", $value, $id, $field );
                        $value = apply_filters( "acf/format_value/name={$field['_name']}", $value, $id, $field );
                        $value = apply_filters( "acf/format_value/key={$field['key']}", $value, $id, $field );
                        $value_node = $value;

                        // Store the formatted value. This is stored for a shorter time to prevent data incoherent data.
                        wp_cache_set(
                            'get_field/formatted/' . $id . '/' . $key,
                            $value_node,
                            $cache_group,
                            self::$cache_ttl
                        );
                    }
                    break;

            }

            // Unset the reference to prevent odd bugs to appear
            unset( $value_node );
        }

        // Sort the return array recursively by keys so that the fields are in the right order
        // Should be a fairly quick operation because the array should be pretty much in order already
        self::ksort_recursive( $fields );

        // Run DustPress Components filters for the layouts through previously stored references
        foreach( $layout_filters as $key => &$datas ) {
            foreach( $datas as &$data ) {
                $data = apply_filters( 'dustpress/components/data=' . $key, $data );
            }
        }

        return $fields;
    }

    /**
     * A helper method to sort arrays recursively by key
     *
     * @param array $array       An array to sort
     * @param int   $sort_flags  Possible sorting flags
     * @return boolean
     */
    public static function ksort_recursive( &$array, $sort_flags = SORT_REGULAR ) {
        if ( ! is_array( $array ) ) {
            return false;
        }

        ksort( $array, $sort_flags );
        foreach ( $array as &$arr ) {
            self::ksort_recursive( $arr, $sort_flags );
        }

        return true;
    }

    /**
     * Clears the cache for sorted meta rows.
     * This is done after any meta value is changed.
     *
     * @param int $post_id Post ID.
     */
    public static function flush_sorted_meta( $post_id ) {
        wp_cache_delete( 'sorted_meta_data/' . $post_id, self::$cache_group );
    }

    /**
     * Flus a single value cache if its value is changed.
     *
     * @link https://www.advancedcustomfields.com/resources/acf-update_value/
     *
     * @param mixed  $value
     * @param int    $post_id
     * @param object $field
     */
    public static function flush_formatted_value( $value, $post_id, $field ) {

    }
}
