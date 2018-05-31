<?php
/*
*  ACF - PHP field
*
*/

namespace Geniem\ACF\Fields;

/**
 * ACF PHP Field class.
 */
class ACF_Field_PHP extends \acf_field {
    /**
     * Constructor for the mandatory ACF stuff.
     */
    public function __construct() {
        $this->name = 'php';
        $this->label = __( 'PHP', 'acf-codifier' );
        $this->category = 'layout';
        $this->defaults = array(
            'code'	=> '',
        );

        parent::__construct();
    }

    /**
     * Render the field and run the attached code.
     *
     * @param array $field The field object.
     * @return void
     */
    public function render_field( $field ) {
        if ( is_callable( $field['code'] ) ) {
            \call_user_func( $field['code'] );
        }
    }

    /**
     * Show instructions on the admin side.
     *
     * @param array $field The field object.
     * @return void
     */
    public function render_field_settings( $field ) {
        acf_render_field_setting( $field, array(
			'label'			=> __( 'Instructions', 'acf-codifier' ),
			'type'			=> 'message',
			'message'		=> __( 'This field can only be used with ACF Codifier. Doesn\'t do anything if defined in the admin side.', 'acf-codifier' ),
		));
    }
}

new ACF_Field_PHP();
