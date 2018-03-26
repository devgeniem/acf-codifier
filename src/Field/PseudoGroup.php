<?php
/**
 * Acf codifier group field
 */

namespace Geniem\ACF\Field;

/**
 * Class Group
 */
class PseudoGroup extends \Geniem\ACF\Field\PseudoGroupableField {
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
    public $sub_fields;

    /**
     * Export empty array because this is not a real field.
     *
     * @param boolean $register Whether we are registering the field or not.
     * @return array
     */
    public function export( $register = false ) {
        $obj = get_object_vars( $this );

        // Remove unnecessary properties from the exported array.
        unset( $obj['inheritee'] );
        unset( $obj['groupable'] );
        unset( $obj['fields_var'] );
        unset( $obj['filters'] );

        // Loop through fields and export them.
        if ( ! empty( $obj[ $this->fields_var ] ) ) {
            foreach ( $obj[ $this->fields_var ] as $field ) {
                $sub_fields = [];

                if ( $field instanceof \ Geniem\ACF\Field\Tab ||
                    $field instanceof \ Geniem\ACF\Field\Accordion ||
                    $field instanceof \ Geniem\ACF\Field\PseudoGroup ) {
                    // Get the subfields from the tab
                    $sub_fields = $field->get_fields();
                }

                $fields[ $field->get_key() ] = $field->export( $register );

                // Add the possibly stored subfields
                if ( ! empty( $sub_fields ) ) {
                    foreach ( $sub_fields as $sub_field ) {
                        $fields[ $sub_field->get_key() ] = $sub_field->export( $register );
                    }

                    unset( $sub_fields );
                }
            }

            // Remove keys, ACF requires the arrays to be numbered.
            $obj[ $this->fields_var ] = array_filter( array_values( $fields ) );
        }

        // Convert the wrapper class array to a space-separated string.
        if ( isset( $obj['wrapper']['class'] ) && ! empty( $obj['wrapper']['class'] ) ) {
            $obj['wrapper']['class'] = implode( ' ', $obj['wrapper']['class'] );
        }
        else {
            $obj['wrapper']['class'] = '';
        }

        return $obj;
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
    public function clone( $key = null, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->{ $this->fields_var } = array_map( function( $field ) use ( $key ) {
            return $field->clone( $key . '_' . $field->get_key() );
        }, $clone->{ $this->fields_var });

        $clone->update_self( $this );

        return $clone;
    }
}
