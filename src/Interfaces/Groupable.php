<?php
/**
 * ACF Codifier Groupable interface
 */

namespace Geniem\ACF\Interfaces;

/**
 * Groupable interface
 *
 * @see \Geniem\ACF\Field\Common\Groupable
 */
interface Groupable {
    public function export( $register = false );
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' );
    public function add_fields( array $fields, $order = 'last' );
    public function add_field_before( \Geniem\ACF\Field $field, $target );
    public function add_field_after( \Geniem\ACF\Field $field, $target );
    public function remove_field( string $field_name );
    public function set_fields( $fields );
    public function get_fields_from( GroupableInterface $groupable );
    public function get_fields();
    public function get_field( $name );
    public function remove_fields();
    public function clone( $key, $name = null );
    public function fields_var() : string;
}