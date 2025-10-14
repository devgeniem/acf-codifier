<?php
/**
 *  ACF - Multisite Post Object field
 */

namespace Geniem\ACF\Fields;

add_action(
    'acf/init', function () {

        /**
         * ACF Multisite Post Object class
         */
        class MultisitePostObject extends \acf_field_post_object {

            /**
             * Initialize the field.
             *
             * @return void
             */
            public function initialize() {
                // Field properties.
                $this->name     = 'multisite_post_object';
                $this->label    = __( 'Multisite Post Object', 'acf' );
                $this->category = 'relational';
                $this->defaults = [
                    'post_type'     => [],
                    'taxonomy'      => [],
                    'allow_null'    => 0,
                    'multiple'      => 0,
                    'return_format' => 'object',
                    'ui'            => 1,
                    'blog_id'       => \get_current_blog_id(),
                ];
                // Ajax hooks.
                \add_action( 'wp_ajax_acf/fields/multisite_post_object/query', [ $this, 'ajax_query' ] );
                \add_action( 'wp_ajax_nopriv_acf/fields/multisite_post_object/query', [ $this, 'ajax_query' ] );
            }

            /**
             * Enqueue admin scripts.
             *
             * @return void
             */
            public function input_admin_enqueue_scripts() {
                $src = \plugin_dir_url( realpath( __DIR__ . '/..' ) . '/plugin.php' );
                // Strip the src
                $src = \str_replace( '/src/', '/', $src );
                \wp_enqueue_script(
                    'acf_multisite_post_object', $src . 'assets/scripts/multisite-post-object.js', [ 'acf-input' ]
                );
            }

            /**
             * Switch to the selected blog when using
             * the parent method for fetching the AJAX response.
             *
             * @param array $options The options array.
             *
             * @return mixed
             */
            public function get_ajax_query( $options = [] ) {
                $field   = acf_get_field( $options['field_key'] );
                $blog_id = $field['blog_id'];

                \switch_to_blog( $blog_id );
                add_filter( 'acf/fields/post_object/query', [ $this, 'polylang_filter' ], 100, 1 );
                $response = parent::get_ajax_query( $options );
                remove_filter( 'acf/fields/post_object/query', [ $this, 'polylang_filter' ], 100 );
                \restore_current_blog();

                return $response;
            }

            /**
             * A plugin specific fix for Polylang injecting wrong language taxonomy IDs with switch_to_blog.
             *
             * @param array $args    The arguments to filter.
             *
             * @return array
             */
            public function polylang_filter( $args ) {

                if ( function_exists( 'pll_current_language' ) && empty( $args['lang'] ) ) {
                    $args['lang'] = \pll_current_language();
                }

                return $args;
            }

            /**
             * Get post title.
             *
             * @param mixed   $post      The post.
             * @param mixed   $field     Field.
             * @param integer $post_id   Post ID.
             * @param integer $is_search Is search.
             * @param boolean $unescape  Unescape.
             *
             * @return string
             */
            public function get_post_title( $post, $field, $post_id = 0, $is_search = 0, $unescape = false ) {
                \switch_to_blog( $field['blog_id'] );
                $title = parent::get_post_title( $post, $field, $post_id, $is_search, $unescape );
                \restore_current_blog();

                // return
                return $title;
            }

            /**
             * Render field.
             *
             * @param array $field Render field.
             *
             * @return void
             */
            public function render_field( $field ) {
                \switch_to_blog( $field['blog_id'] );

                // If Polylang is active, we need to switch the global curlang manually
                // as switch_to_blog does not do that in admin views.
                // If this is not done, the field may not find its saved value if the taxonomy term IDs
                // do not match between all sites.
                if ( function_exists( 'pll_default_language' ) ) {
                    $restore_curlang = \PLL()->curlang;
                    $lang = \PLL()->model->get_language( $restore_curlang->slug );
                    \PLL()->curlang = $lang ?: \PLL()->model->get_language( \pll_default_language() );
                    parent::render_field( $field );
                    \PLL()->curlang = $restore_curlang;
                }
                else {
                    parent::render_field( $field );
                }

                \restore_current_blog();
            }

            /**
             * Format value.
             *
             * @param mixed $value   Value.
             * @param mixed $post_id Post ID.
             * @param mixed $field   Field.
             *
             * @return mixed
             */
            public function format_value( $value, $post_id, $field ) {
                \switch_to_blog( $field['blog_id'] );
                $value = parent::format_value( $value, $post_id, $field );
                \restore_current_blog();

                return $value;
            }

        }

        // Initialize.
        new MultisitePostObject();
    }
);
