<?php
/**
 * ACF Ajax query trait for custom field types.
 */

namespace Geniem\ACF\Fields;

/**
 * Trait AcfAjaxQueryTrait
 *
 * Overrides the parent ajax_query() to pass the correct field type name
 * to acf_verify_ajax(). Required since ACF 6.8.4, which added field-type
 * validation to AJAX nonce checks. Without this override the parent would
 * pass its own type (e.g. 'post_object', 'relationship', 'taxonomy') instead
 * of the custom type registered by the subclass, causing verification to fail.
 *
 * Classes using this trait must set $this->name to the registered field type
 * string inside initialize().
 */
trait AcfAjaxQueryTrait {

    /**
     * Override parent ajax_query to use correct field type for nonce verification.
     *
     * @return void
     */
    public function ajax_query() {
        $nonce             = \acf_request_arg( 'nonce', '' );
        $key               = \acf_request_arg( 'field_key', '' );
        $conditional_logic = (bool) \acf_request_arg( 'conditional_logic', false );

        if ( $conditional_logic ) {
            if ( ! \acf_current_user_can_admin() ) {
                die();
            }

            $nonce = '';
            $key   = '';
        }

        if ( ! \acf_verify_ajax( $nonce, $key, ! $conditional_logic, $this->name ) ) {
            die();
        }

        \acf_send_ajax_results( $this->get_ajax_query( $_POST ) );
    }
}
