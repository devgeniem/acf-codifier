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
    public function export( bool $register = false ) : ?array;
    public function add_field( \Geniem\ACF\Field $field, string $order = 'last' ) : \Geniem\ACF\Interfaces\Groupable;
    public function add_fields( array $fields, string $order = 'last' ) : \Geniem\ACF\Interfaces\Groupable;
    public function add_field_before( \Geniem\ACF\Field $field, $target ) : \Geniem\ACF\Interfaces\Groupable;
    public function add_field_after( \Geniem\ACF\Field $field, $target ) : \Geniem\ACF\Interfaces\Groupable;
    public function add_fields_from( \Geniem\ACF\Interfaces\Groupable $groupable, string $order = 'last' ) : \Geniem\ACF\Interfaces\Groupable;
    public function remove_field( string $field_name ) : \Geniem\ACF\Interfaces\Groupable;
    public function set_fields( array $fields ) : \Geniem\ACF\Interfaces\Groupable;
    public function set_fields_from( \Geniem\ACF\Interfaces\Groupable $groupable ) : \Geniem\ACF\Interfaces\Groupable;
    public function get_fields() : array;
    public function get_field( string $name ) : ?Field;
    public function remove_fields() : \Geniem\ACF\Interfaces\Groupable;
    public function clone( string $key, string $name = null );
    public function fields_var() : string;
    // phpcs:enable
}