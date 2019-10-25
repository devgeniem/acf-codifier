<?php
/**
 * ACF Codifier Groupable interface
 */

namespace Geniem\ACF\Interfaces;

use Geniem\ACF\Field;

/**
 * Groupable interface
 *
 * @see \Geniem\ACF\Field\Common\Groupable
 */
interface Groupable {
    // phpcs:disable
    public function export( bool $register = false ) : array;
    public function add_field( \Geniem\ACF\Field $field, string $order = 'last' ) : Groupable;
    public function add_fields( array $fields, string $order = 'last' ) : Groupable;
    public function add_field_before( \Geniem\ACF\Field $field, $target ) : Groupable;
    public function add_field_after( \Geniem\ACF\Field $field, $target ) : Groupable;
    public function add_fields_from( Groupable $groupable ) : Groupable;
    public function remove_field( string $field_name ) : Groupable;
    public function set_fields( array $fields ) : Groupable;
    public function set_fields_from( Groupable $groupable ) : Groupable;
    public function get_fields() : array;
    public function get_field( string $name ) : ?Field;
    public function remove_fields() : Groupable;
    public function clone( string $key, string $name = null ) : Groupable;
    public function fields_var() : string;
    // phpcs:enable
}