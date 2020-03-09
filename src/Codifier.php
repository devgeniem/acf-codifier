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
     * Init function for registering actions
     *
     * @return void
     */
    public static function init() {
        // Hook to ACF's acf/is_field_key check.
        add_filter( 'acf/is_field_key', '\\Geniem\ACF\\Field::acf_is_field_key', 10, 2 );

        // Enable label hiding.
        add_action( 'admin_head', __CLASS__ . '::hide_labels' );

        // Add some actions for RediPress search if it's enabled.
        add_action( 'redipress/before_index_post', '\\Geniem\\ACF\\Field::redipress_get_fields', 10, 1 );
        add_action( 'redipress/before_index_user', '\\Geniem\\ACF\\Field::redipress_get_fields', 10, 1 );
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

                echo 'div.acf-field.acf-field-' . esc_attr( $key ) . " > div.acf-label > label { display: none; }\n";
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
}
