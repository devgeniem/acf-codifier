<?php
/**
 * ACF Codifier Gravity Forms field
 */

namespace Geniem\ACF\Field;

/**
 * Class GravityForms
 */
class GravityForms extends \Geniem\ACF\Field\Select {

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'gravity_forms';

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        parent::__construct( $label, $key, $name );

        if ( ! class_exists( '\GFFormsModel' ) ) {
            $this->disable();
            $this->add_choice( 'Gravity Forms is not activated.' );
            return;
        }

        if ( is_admin() ) {
            $this->populate_options();
        }
    }

    /**
     * Populate the Gravity Forms forms
     *
     * @return void
     */
    protected function populate_options() {
        global $wpdb;

        $table_name = \GFFormsModel::get_form_table_name();

        $sql   = "SELECT id, title from $table_name where is_active = %d and is_trash = %d";
        $query = $wpdb->prepare( $sql, 1, 0 ); // phpcs:ignore

        $gf_form_results = $wpdb->get_results( $query ); // phpcs:ignore

        if ( ! empty( $gf_form_results ) ) {
            foreach ( $gf_form_results as $gf_form ) {
                $this->add_choice( $gf_form->title, $gf_form->id );
            }
        }
    }

    /**
     * A deprecated function to cover previous functionality.
     *
     * @param string $return_format Not used parameter.
     * @return self
     */
    public function set_return_format( string $return_format = 'object' ) {
        trigger_error( 'ACF Codifier: Gravity Forms field method "set_return_format" is deprecated and does no longer function.' ); // phpcs: ignore

        return $this;
    }

    /**
     * A deprecated function to cover previous functionality.
     *
     * @return string
     */
    public function get_return_format() {
        trigger_error( 'ACF Codifier: Gravity Forms field method "get_return_format" is deprecated and does no longer function.' ); // phpcs: ignore

        return 'id';
    }
}
