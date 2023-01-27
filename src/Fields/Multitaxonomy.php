<?php
/**
 *  ACF - Multitaxonomy field
 */

namespace Geniem\ACF\Fields;

add_action( 'acf/init', function() {
    /**
     * ACF Multitaxonomy class
     */
    class Multitaxonomy extends \acf_field_taxonomy {

        /**
         * Initialize the field
         *
         * @return void
         */
        public function initialize() {

            // vars
            $this->name     = 'multitaxonomy';
            $this->label    = __( 'Multitaxonomy', 'acf' );
            $this->category = 'relational';
            $this->defaults = array(
                'taxonomy'      => [ 'category' ],
                'field_type'    => 'select',
                'multiple'      => 0,
                'allow_null'    => 0,
                'return_format' => 'id',
                'add_term'      => 0, // 5.2.3
                'load_terms'    => 0, // 5.2.7
                'save_terms'    => 0 // 5.2.7
            );
            // extra
            \add_action( 'wp_ajax_acf/fields/multitaxonomy/query', [ $this, 'ajax_query' ] );
            \add_action( 'wp_ajax_nopriv_acf/fields/multitaxonomy/query', [ $this, 'ajax_query' ] );
            // actions
            add_action( 'acf/save_post', [ $this, 'save_post' ], 15, 1 );
        }

        /**
         * Enqueue admin scripts
         *
         * @return void
         */
        public function input_admin_enqueue_scripts() {
            $src = \plugin_dir_url( realpath( __DIR__ . '/..' ) . '/plugin.php' );

            // Strip the src
            $src = \str_replace( '/src/', '/', $src );

            \wp_enqueue_script( 'acf_multitaxonomy', $src . 'assets/scripts/multitaxonomy.js', [ 'acf-input' ] );
        }

        /**
         *  This function will return an array of data formatted for use in a select2 AJAX response
         *
         *  @param   array $options Ajax options.
         *  @return  array
         */
        function get_ajax_query( $options = [] ) {

            // defaults
            $options = acf_parse_args(
                $options, array(
                    'post_id'   => 0,
                    's'         => '',
                    'field_key' => '',
                    'paged'     => 0,
                )
            );

            // load field
            $field = acf_get_field( $options['field_key'] );
            if ( ! $field ) { return false;
            }

            // bail early if a taxonomy does not exist
            $taxonomies_exist = $this->taxonomies_exist( $field['taxonomy'] );
            if ( ! $taxonomies_exist ) {
                return false;
            }

            // vars
            $results = array();
            $limit   = PHP_INT_MAX; // fetch all terms

            // args
            $args = array(
                'taxonomy'   => $field['taxonomy'],
                'hide_empty' => false,
            );

            // search
            if ( ! empty( $options['s'] ) ) {

                // strip slashes (search may be integer)
                $s = wp_unslash( strval( $options['s'] ) );

                // update vars
                $args['search'] = $s;
            }

            // filters
            $args = apply_filters( 'acf/fields/multitaxonomy/query', $args, $field, $options['post_id'] );
            $args = apply_filters( 'acf/fields/multitaxonomy/query/name=' . $field['name'], $args, $field, $options['post_id'] );
            $args = apply_filters( 'acf/fields/multitaxonomy/query/key=' . $field['key'], $args, $field, $options['post_id'] );

            // get terms
            $terms = $this->get_all_terms( $args );

            // append to results
            foreach ( $terms as $term ) {
                // add to json
                $results[] = array(
                    'id'   => $term->term_id,
                    'text' => $this->get_term_title( $term, $field, $options['post_id'] ),
                );
            }

            // vars
            $response = array(
                'results' => $results,
                'limit'   => $limit,
            );

            // return
            return $response;

        }

        /**
         *  This function returns the value label for the input element on the admin side.
         *
         *  @param   \WP_Term $term    The term object.
         *  @param   array    $field   The field settings.
         *  @param   int      $post_id The post_id to which this value is saved to
         *  @return  string
         */
        function get_term_title( $term, $field, $post_id = 0 ) {

            // get post_id
            if ( ! $post_id ) {
                $post_id = acf_get_form_data( 'post_id' );
            }

            $taxonomy = get_taxonomy( $term->taxonomy );

            // vars
            $title = $taxonomy->label . ': ';

            // ancestors
            $ancestors = get_ancestors( $term->term_id );

            if ( ! empty( $ancestors ) ) {
                $title .= str_repeat( '- ', count( $ancestors ) );
            }

            // title
            $title .= $term->name;

            // filters
            $title = apply_filters( 'acf/fields/taxonomy/result', $title, $term, $field, $post_id );
            $title = apply_filters( 'acf/fields/taxonomy/result/name=' . $field['_name'], $title, $term, $field, $post_id );
            $title = apply_filters( 'acf/fields/taxonomy/result/key=' . $field['key'], $title, $term, $field, $post_id );

            // return
            return $title;
        }

        /**
         * Get terms for given arguments.
         *
         * @param array $args Query args.
         *
         * @return \WP_Term[]|int|\WP_Error List of WP_Term instances and their children.
         *                                  Will return WP_Error, if any of taxonomies do not exist.
         */
        protected function get_all_terms( $args ) {

            // defaults
            $args = wp_parse_args( $args, [
                'taxonomy'					=> null,
                'hide_empty'				=> false,
                'update_term_meta_cache'	=> false,
            ] );

            // parameters changed in version 4.5
            if( acf_version_compare('wp', '<', '4.5') ) {
                return get_terms( $args['taxonomy'], $args );
            }

            // Get all terms. We encourage using a persistent object-cache
            // that enables WP to cache term queries to make this faster for most queries.
            $terms = get_terms( $args );

            return $terms;
        }

        /**
         *  This function will return an array of terms for a given field value
         *
         * @param array $value    Selected value(s).
         * @param array $taxonomy Taxonomies the field uses.
         *
         * @return \WP_Term[]|int|\WP_Error List of WP_Term instances and their children.
         *                                  Will return WP_Error, if any of taxonomies do not exist.
         */
        public function get_terms( $value, $taxonomy = [ 'category' ] ) {

            // load terms in 1 query to save multiple DB calls from following code
            if ( count( $value ) > 1 ) {

                $terms = acf_get_terms(
                    array(
                        'taxonomy'   => $taxonomy,
                        'include'    => $value,
                        'hide_empty' => false,
                    )
                );

            }

            // update value to include $post
            foreach ( array_keys( $value ) as $i ) {

                $value[ $i ] = get_term( $value[ $i ] );

            }

            // filter out null values
            $value = array_filter( $value );

            // return
            return $value;
        }

        /**
         *  This filter is appied to the $value after it is loaded from the db
         *
         *  @param array      $value   The value found in the database.
         *  @param int        $post_id The $post_id from which the value was loaded from.
         *  @param \acf_field $field   The field array holding all the field options.
         *
         *  @return array The value to be saved into db.
         */
        function load_value( $value, $post_id, $field ) {

            // force into array
            $value = acf_get_array( $value );


            // force ints
            $value = array_map( 'intval', $value );

            // load_terms
            if ( ! empty( $field['load_terms'] ) ) {

                // get terms
                $info     = acf_get_post_id_info( $post_id );
                $term_ids = wp_get_object_terms(
                    $info['id'], $field['taxonomy'], array(
                        'fields'  => 'ids',
                        'orderby' => 'none',
                    )
                );

                // bail early if no terms
                if ( empty( $term_ids ) || is_wp_error( $term_ids ) ) { return false;
                }

                // sort
                if ( ! empty( $value ) ) {

                    $order = array();

                    foreach ( $term_ids as $i => $v ) {

                        $order[ $i ] = array_search( $v, $value );

                    }

                    array_multisort( $order, $term_ids );

                }

                // update value
                $value = $term_ids;

            }

            // convert back from array if neccessary
            if ( $field['field_type'] == 'select' || $field['field_type'] == 'radio' ) {

                $value = array_shift( $value );

            }

            // return
            return $value;

        }

        /**
         *  This filter is appied to the $value before it is updated in the db

         *  @param array $value   The value that will be save in the database.
         *  @param int   $post_id The $post_id from which the value was loaded from.
         *  @param array $field   The field array holding all the field options.
         *
         *  @return array The modified value.
         */
        public function update_value( $value, $post_id, $field ) {

            // vars
            if ( is_array( $value ) ) {

                $value = array_filter( $value );

            }

            // save_terms
            if ( ! empty( $field['save_terms'] ) ) {

                // force value to array
                $term_ids = acf_get_array( $value );

                // convert to int
                $term_ids = array_map( 'intval', $term_ids );

                $new_terms = [];

                // Gather new term ids and group by taxonomy.
                foreach ( $term_ids as $term_id ) {
                    $term     = get_term( $term_id );

                    if ( empty( $this->save_post_terms[ $term->taxonomy ] ) ) {
                        $new_terms[ $term->taxonomy ] = [];
                    }

                    $new_terms[] = $term_id;
                }

                // Merge old values with new ones.
                foreach ( $new_terms as $taxonomy => $terms_per_tax ) {
                    // get existing term id's (from a previously saved field)
                    $old_term_ids = isset( $this->save_post_terms[ $taxonomy ] ) ? $this->save_post_terms[ $taxonomy ] : array();
                    // append
                    $this->save_post_terms[ $taxonomy ] = array_merge( $old_term_ids, $term_ids );
                }

                // if called directly from frontend update_field()
                if ( ! did_action( 'acf/save_post' ) ) {

                    $this->save_post( $post_id );

                    return $value;

                }
            }

            // return
            return $value;

        }

        /**
         *  Create the HTML interface for your field
         *
         *  @param array $field The field data.
         */
        public function render_field( $field ) {

            // force value to array
            $field['value'] = acf_get_array( $field['value'] );

            // vars
            $div = array(
                'class'           => 'acf-multitaxonomy-field',
                'data-save'       => $field['save_terms'],
                'data-ftype'      => $field['field_type'],
                'data-taxonomy'   => $field['taxonomy'],
                'data-allow_null' => $field['allow_null'],
            );

            // get taxonomy
            $all_exist = $this->taxonomies_exist( $field['taxonomy'] );

            // bail early if a taxonomy does not exist
            if ( ! $all_exist ) {
                return;
            }

            ?>
            <div <?php acf_esc_attr_e( $div ); ?>>
                <?php

                if ( $field['field_type'] == 'select' ) {

                    $field['multiple'] = 0;

                    $this->render_field_select( $field );

                } elseif ( $field['field_type'] == 'multi_select' ) {

                    $field['multiple'] = 1;

                    $this->render_field_select( $field );

                } elseif ( $field['field_type'] == 'radio' ) {

                    $this->render_field_checkbox( $field );

                } elseif ( $field['field_type'] == 'checkbox' ) {

                    $this->render_field_checkbox( $field );

                }

                ?>
            </div>
            <?php
        }

        /**
         * Render field select
         *
         * @param array $field The field object.
         * @return void
         */
        public function render_field_select( $field ) {

            // Change Field into a select
            $field['type']     = 'select';
            $field['ui']       = 1;
            $field['ajax']     = 1;
            $field['choices']  = array();
            $field['disabled'] = $field['disable'] ?? false;

            // value
            if ( ! empty( $field['value'] ) ) {
                // get terms
                $terms = $this->get_terms( $field['value'], $field['taxonomy'] );

                // set choices
                if ( ! empty( $terms ) ) {
                    foreach ( array_keys( $terms )  as $i ) {
                        // vars
                        $term = acf_extract_var( $terms, $i );

                        // append to choices
                        $field['choices'][ $term->term_id ] = $this->get_term_title( $term, $field );
                    }
                }
            }

            // render select
            acf_render_field( $field );
        }

        /**
         * Render field checkbox
         *
         * @param array $field The field object.
         */
        public function render_field_checkbox( $field ) {

            // hidden input
            acf_hidden_input(array(
                'type' => 'hidden',
                'name' => $field['name'],
            ));

            // checkbox saves an array
            if ( $field['field_type'] === 'checkbox' ) {
                $field['name'] .= '[]';
            }

            // include default walker
            acf_include('includes/walkers/class-acf-walker-taxonomy-field.php');

            $walker = new class( $field ) extends \ACF_Taxonomy_Field_Walker {
                /**
                 * Start el function
                 *
                 * @param string  $output            Output string.
                 * @param array   $term              The term array.
                 * @param integer $depth             How far into the tree we are.
                 * @param array   $args              Possible arguments.
                 * @param integer $current_object_id Current object id.
                 * @return void
                 */
                function start_el( &$output, $term, $depth = 0, $args = array(), $current_object_id = 0 ) { //phpcs:ignore
                    // vars
                    $selected = in_array( $term->term_id, $this->field['value'], true );
                    // append
                    $output .= '<li data-id="' . $term->term_id . '"><label' . ( $selected ? ' class="selected"' : '' ) . '><input type="' . $this->field['field_type'] . '" name="' . $this->field['name'] . '" value="' . $term->term_id . '" ' . ( $selected ? 'checked="checked"' : '' ) . ( $args['disable'] ? ' disabled="disabled"' : '' ) . ' /> <span>' . ( ( $args['cat_count'] > 1 ) ? ( $term->taxonomy . ': ' ) : '' ) . $term->name . '</span></label>';
                }
            };

            if ( ! is_array( $field['taxonomy'] ) ) {
                $field['taxonomy'] = [ $field['taxonomy'] ];
            }

            $output    = '';
            $cat_count = count( $field['taxonomy'] );

            foreach ( $field['taxonomy'] as $taxonomy ) {
                // taxonomy
		        $taxonomy_obj = get_taxonomy( $taxonomy );

                // vars
                $args = array(
                    'taxonomy'         => $taxonomy,
                    'show_option_none' => sprintf( _x( 'No %s', 'No terms', 'acf' ), strtolower( $taxonomy_obj->labels->name ) ),
                    'hide_empty'       => false,
                    'style'            => 'none',
                    'walker'           => $walker,
                    'echo'             => false,
                    'cat_count'        => $cat_count,
                    'disable'          => $field['disable'] ?? false,
                );

                // filter for 3rd party customization
                $args = apply_filters('acf/fields/taxonomy/wp_list_categories', $args, $field);
                $args = apply_filters('acf/fields/taxonomy/wp_list_categories/name=' . $field['_name'], $args, $field);
                $args = apply_filters('acf/fields/taxonomy/wp_list_categories/key=' . $field['key'], $args, $field);

                $output .= wp_list_categories( $args );
            }

            ?>
    <div class="categorychecklist-holder">
        <ul class="acf-checkbox-list acf-bl">
            <?php echo $output; ?>
        </ul>
    </div>
            <?php
        }

        /**
         * Check if all taxonomies exist in a given array.
         *
         * @param array $taxonomies Taxonomy names.
         *
         * @return bool
         */
        protected function taxonomies_exist( array $taxonomies = [] ) {
            $taxonomies_exist = array_map( 'taxonomy_exists', $taxonomies );
            if ( in_array( false, $taxonomies_exist, true ) ) {
                return false;
            }

            return true;
        }
    }

    // initialize
    new Multitaxonomy();
});
