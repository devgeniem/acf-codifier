<?php
/**
 *  ACF - MultisiteTaxonomy field
 */

namespace Geniem\ACF\Fields;

add_action( 'acf/init', function() {
    /**
     * ACF MultisiteTaxonomy Relationship class
     */
    class ACF_Field_Multisite_Taxonomy extends Multitaxonomy {

        /**
         * Initialize the field
         *
         * @return void
         */
        public function initialize() {

            // vars
            $this->name     = 'multisite_taxonomy';
            $this->label    = __( 'Multisite taxonomy', 'acf' );
            $this->category = 'relational';
            $this->defaults = array(
                'taxonomy'      => [ 'category' ],
                'field_type'    => 'select',
                'multiple'      => 0,
                'allow_null'    => 0,
                'return_format' => 'id',
                'add_term'      => 0, // 5.2.3
                'blog_id'       => \get_current_blog_id(),
            );
            // extra
            \add_action( 'wp_ajax_acf/fields/multisite_taxonomy/query', [ $this, 'ajax_query' ] );
            \add_action( 'wp_ajax_nopriv_acf/fields/multisite_taxonomy/query', [ $this, 'ajax_query' ] );
            \add_action( 'wp_ajax_acf/fields/multisite_taxonomy/add_term', [ $this, 'ajax_add_term' ] );
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

            \wp_enqueue_script( 'acf_multisite_taxonomy', $src . 'assets/scripts/multisite_taxonomy.js', [ 'acf-input' ] );
        }

        /**
         *  This function will return an array of data formatted for use in a select2 AJAX response
         *
         *  @param   array $options Ajax options.
         *  @return  array
         */
        function get_ajax_query( $options = [] ) {

            $field = acf_get_field( $options['field_key'] );

            if ( ! $field ) {
                return false;
            }

            $blog_id = $field['blog_id'];

            \switch_to_blog( $blog_id );

            // defaults
            $options = acf_parse_args(
                $options, array(
                    'post_id'   => 0,
                    's'         => '',
                    'field_key' => '',
                    'paged'     => 0,
                )
            );


            // bail early if a taxonomy does not exist
            $taxonomies_exist = $this->taxonomies_exist( $field['taxonomy'] );

            if ( ! $taxonomies_exist ) {
                \restore_current_blog();
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
            $args = apply_filters( 'acf/fields/multisite_taxonomy/query', $args, $field, $options['post_id'] );
            $args = apply_filters( 'acf/fields/multisite_taxonomy/query/name=' . $field['name'], $args, $field, $options['post_id'] );
            $args = apply_filters( 'acf/fields/multisite_taxonomy/query/key=' . $field['key'], $args, $field, $options['post_id'] );

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

            \restore_current_blog();

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
            $title = apply_filters( 'acf/fields/multisite_taxonomy/result', $title, $term, $field, $post_id );
            $title = apply_filters( 'acf/fields/multisite_taxonomy/result/name=' . $field['_name'], $title, $term, $field, $post_id );
            $title = apply_filters( 'acf/fields/multisite_taxonomy/result/key=' . $field['key'], $title, $term, $field, $post_id );

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
                'taxonomy'               => null,
                'hide_empty'             => false,
                'update_term_meta_cache' => false,
            ] );

            // parameters changed in version 4.5
            if( acf_version_compare( 'wp', '<', '4.5' ) ) {
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

            \switch_to_blog( $field['blog_id'] );

            $value = parent::load_value( $value, $post_id, $field );

            \restore_current_blog();

            // return
            return $value;

        }

        /**
         *  This filter is applied to the $value before it is updated in the db

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

            // return
            return $value;

        }

        /**
         *  Create the HTML interface for your field
         *
         *  @param array $field The field data.
         */
        public function render_field( $field ) {

            \switch_to_blog( $field['blog_id'] );

            // force value to array
            $field['value'] = acf_get_array( $field['value'] );

            // vars
            $div = array(
                'class'           => 'acf-multisite-taxonomy-field',
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

            \restore_current_blog();

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

        /**
         * Add term via ajax
         */
        public function ajax_add_term() {
            // vars
            $args = wp_parse_args( $_POST, array(
                'nonce'       => '',
                'field_key'   => '',
                'term_name'   => '',
                'term_parent' => '',
            ));

            // load field
            $field = acf_get_field( $args['field_key'] );
            if ( ! $field ) {
                die();
            }

            parent::ajax_add_term();

            \switch_to_blog( $field['blog_id'] );
        }
    }

    // initialize
    new ACF_Field_Multisite_Taxonomy();
});
