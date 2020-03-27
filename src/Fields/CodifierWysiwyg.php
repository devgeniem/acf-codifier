<?php
/*
*  Codifier's extended Wysiwyg field
*
*/

namespace Geniem\ACF\Fields;

add_action( 'acf/init', function() {
    /**
     * ACF Extended Wysiwyg Field class.
     */
    class ACF_Field_Extended_Wysiwyg extends \acf_field_wysiwyg {
        /**
         * Constructor for the mandatory ACF stuff.
         */
        public function initialize() {
            parent::initialize();

            $this->name     = 'extended_wysiwyg';
            $this->label    = 'ACF Codifier Extended Wysiwyg Editor';
            $this->defaults = array(
                'tabs'      	=> 'all',
                'toolbar'		=> 'full',
                'media_upload' 	=> 1,
                'default_value'	=> '',
                'delay'			=> 0,
                'height'        => 300,
            );
        }

        /**
         * Render field function
         *
         * @param array $field The field object.
         * @return void
         */
        public function render_field( $field ) {
            ob_start();
            parent::render_field( $field );
            $return = ob_get_clean();

            // Get ACF default wysiwyg height
            $height = acf_get_user_setting( 'wysiwyg_height', 300 );
            $height = max( $height, 300 );

            echo str_replace( "height:${height}px;", 'height:'. $field['height'] . 'px;', $return );

            static $min_height_zero = false;

            if ( ! $min_height_zero ) {
                echo '<style>.acf-editor-wrap iframe { min-height: 0; }</style>';
                $min_height_zero = true;
            }
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

                \wp_enqueue_script( 'acf_extended_wysiwyg', $src . 'assets/scripts/extended-wysiwyg.js', [ 'acf-input' ] );
            }
    }

    new ACF_Field_Extended_Wysiwyg();
});