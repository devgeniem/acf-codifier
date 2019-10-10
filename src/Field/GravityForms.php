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
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        parent::__construct( $label, $key, $name );

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

        $table_name = GFFormsModel::get_form_table_name();

        $sql        = "SELECT id, title from $table_name where is_active = %d and is_trash = %d";
        $query      = $wpdb->prepare( $sql, 1, 0 ); // phpcs:ignore

        $gf_form_results = $wpdb->get_results( $query ); // phpcs:ignore

        if ( ! empty( $gf_form_results ) ) {
            foreach ( $gf_form_results as $gf_form ) {
                $this->add_choice( $gf_form->title, $gf_form->id );
            }
        }
    }
}
