<?php
/**
 * ACF Codifier pseudo group field
 */

namespace Geniem\ACF\Field;

/**
 * Class PseudoGroup
 */
class PseudoGroup extends GroupableField implements PseudoGroupableField {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'pseudo_group';

    /**
     * Fields
     *
     * @var array
     */
    public $sub_fields = [];

    /**
     * Export empty array because this is not a real field.
     *
     * @param boolean $register Whether we are registering the field or not.
     * @param mixed   $parent   Possible parent object.
     *
     * @return array
     */
    public function export( bool $register = false, $parent = null ) : ?array {
        return null;
    }

    /**
     * Clone method
     *
     * No key forcing or prefixing because this is just a pseudo group. Parameters are there just for compatibility.
     *
     * @param string $key  Field key (optional).
     * @param string $name Field name (optional).
     * @return Geniem\ACF\Field
     */
    public function clone( string $key, string $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->{ $this->fields_var() } = array_map( function( $field ) use ( $key ) {
            return $field->clone( $key . '_' . $field->get_key() );
        }, $clone->{ $this->fields_var() });

        return $clone;
    }
}
