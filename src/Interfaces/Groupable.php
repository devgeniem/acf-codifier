<?php
/**
 * ACF Codifier Groupable interface
 */

namespace Geniem\ACF\Interfaces;

use Geniem\ACF\Field;
use Geniem\ACF\Interfaces\Groupable as GroupableInterface;

/**
 * Groupable interface
 *
 * @see \Geniem\ACF\Field\Common\Groupable
 */
interface Groupable {
    // phpcs:disable
    public function export( bool $register = false ) : array;
    public function add_field( \Geniem\ACF\Field $field, string $order = 'last' ) : self;
    public function add_fields( array $fields, string $order = 'last' ) : self;
    public function add_field_before( \Geniem\ACF\Field $field, $target ) : self;
    public function add_field_after( \Geniem\ACF\Field $field, $target ) : self;
    public function add_fields_from( GroupableInterface $groupable ) : self;
    public function remove_field( string $field_name ) : self;
    public function set_fields( array $fields ) : self;
    public function set_fields_from( GroupableInterface $groupable ) : self;
    public function get_fields() : array;
    public function get_field( string $name ) : ?Field;
    public function remove_fields() : self;
    public function clone( string $key, string $name = null ) : self;
    public function fields_var() : string;
    // phpcs:enable
}