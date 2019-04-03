<?php
/**
 * ACF Codifier Groupable trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Groupable Trait
 */
trait Groupable {

    /**
     * Export current field and sub fields to acf compatible format
     *
     * @param boolean $register Whether the field is to be registered.
     *
     * @return array
     */
    public function export( $register = false ) {
        $this->key  = sanitize_title( $this->key );
        $this->name = sanitize_title( $this->name );

        if ( $register && ! empty( $this->filters ) ) {
            array_walk( $this->filters, function( $filter ) {
                $filter = wp_parse_args( $filter, $this->default_filter_arguments );
                add_filter( $filter['filter'] . $this->key, $filter['function'], $filter['priority'], $filter['accepted_args'] );
            });
        }

        $obj = get_object_vars( $this );

        // Remove unnecessary properties from the exported array.
        unset( $obj['filters'] );

        // Allow hide label functionality for Groupables if they are an instance of Field
        if ( $register && $this instanceof \Geniem\ACF\Field && $this->hide_label ) {
            \Geniem\ACF\Codifier::hide_label( $this );
        }

        // Loop through fields and export them.
        if ( ! empty( $obj[ $this->fields_var() ] ) ) {
            foreach ( $obj[ $this->fields_var() ] as $field ) {
                $sub_fields = [];

                if ( $field instanceof \Geniem\ACF\Field\PseudoGroupableField ) {
                    // Get the subfields from the tab
                    $sub_fields = $field->get_fields();
                }

                $fields[ $field->get_key() ] = $field->export( $register );

                // Add the possibly stored subfields
                if ( ! empty( $sub_fields ) ) {
                    $exported_sub_fields = $this->export_sub_fields( $sub_fields, $register );

                    $fields = array_merge( $fields, $exported_sub_fields );
                }
            }

            // Remove keys, ACF requires the arrays to be numbered.
            $obj[ $this->fields_var() ] = array_filter( array_values( $fields ) );
        }

        // Convert the wrapper class array to a space-separated string.
        if ( isset( $obj['wrapper']['class'] ) && ! empty( $obj['wrapper']['class'] ) ) {
            $obj['wrapper']['class'] = implode( ' ', $obj['wrapper']['class'] );
        }
        else {
            $obj['wrapper']['class'] = '';
        }

        if ( ! empty( $obj['conditional_logic'] ) ) {
            foreach ( $obj['conditional_logic'] as &$group ) {
                if ( count( $group ) > 0 ) {
                    foreach ( $group as &$rule ) {
                        if ( ! is_string( $rule['field'] ) ) {
                            $rule['field'] = $rule['field']->get_key();
                        }
                    }
                }
            }
        }

        return $obj;
    }

    /**
     * Helper function to handle possible recursive pseudo group nestings.
     *
     * @param array   $fields Fields to export.
     * @param boolean $register Whether the field group is to be registered.
     * @return array
     */
    private function export_sub_fields( $fields, $register ) {
        $return = [];

        foreach ( $fields as $field ) {
            $sub_fields = [];

            if ( $field instanceof \Geniem\ACF\Field\PseudoGroupableField ) {
                // Get the subfields
                $sub_fields = $field->get_fields();
            }

            $return[] = $field->export( $register );

            // Add the possibly stored subfields
            if ( ! empty( $sub_fields ) ) {
                $exported_sub_fields = $this->export_sub_fields( $sub_fields, $register );

                $return = array_merge( $return, $exported_sub_fields );
            }
        }

        return $return;
    }

    /**
     * Add field to group
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @param string            $order Whether the field is to be added first or last.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        // Add the field to the fields array.
        if ( $order === 'first' ) {
            $this->{ $this->fields_var() } = [ $field->get_name() => $field ] + $this->{ $this->fields_var() };
        }
        else {
            $this->{ $this->fields_var() }[ $field->get_name() ] = $field;
        }

        return $this;
    }

    /**
     * Add an array of fields to group
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param array             $fields An array of fields to be added.
     * @param string            $order Whether the fields are to be added first or last.
     * @return self
     */
    public function add_fields( array $fields, $order = 'last' ) {
        // Add the field to the fields array.
        if ( $order === 'first' ) {
            foreach ( array_reverse( $fields ) as $field ) {
                $this->add_field( $field, 'first' );
            }
        }
        else {
            foreach ( $fields as $field ) {
                $this->add_field( $field );
            }
        }

        return $this;
    }

    /**
     * Add a field to the group before a target field.
     *
     * @param \Geniem\ACF\Field $field  A field to be added.
     * @param [mixed]           $target A target field.
     * @return self
     */
    public function add_field_before( \Geniem\ACF\Field $field, $target ) {
        // Call the real function.
        return $this->add_field_location( $field, 'before', $target );
    }

    /**
     * Add a field to the group after a target field.
     *
     * @param \Geniem\ACF\Field $field  A field to be added.
     * @param [mixed]           $target A target field.
     * @return self
     */
    public function add_field_after( \Geniem\ACF\Field $field, $target ) {
        // Call the real function.
        return $this->add_field_location( $field, 'after', $target );
    }

    /**
     * A method for the two previous methods to use.
     *
     * @throws \Geniem\ACF\Exception Throw error if given target is not valid.
     *
     * @param  \Geniem\ACF\Field $field  A field to be added.
     * @param  [string]          $action Whether it's added before or after.
     * @param  [mixed]           $target A target field.
     * @return self
     */
    private function add_field_location( \Geniem\ACF\Field $field, $action, $target ) {
        // If given a field instance, replace the value with its name.
        if ( $target instanceof \ Geniem\ACF\Field ) {
            $target = $target->get_name();
        }

        // Check if the target field exists in the field group.
        if ( ! isset( $this->{ $this->fields_var() }[ $target ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Groupable: add_field_' . $action . ' can\'t find given target "' . $target . '"' );
        }

        // Make a copy of the fields array to work with.
        $fields = [];

        // Loop through the fields and populate the new array.
        foreach ( $this->{ $this->fields_var() } as $name => $item ) {

            // If this's the spot, do the right thing.
            if ( $action === 'before' && $name === $target ) {
                $fields[ $field->get_name() ] = $field;
            }

            // Insert the original inhabitant.
            $fields[ $name ] = $item;

            // And if this's the spot, do the right thing here.
            if ( $action === 'after' && $name === $target ) {
                $fields[ $field->get_name() ] = $field;
            }
        }

        // Replace the original fields array with the new one.
        $this->{ $this->fields_var() } = $fields;

        return $this;
    }

    /**
     * Remove field from sub fields
     *
     * @param  string $field_name Name of the field to remove.
     * @return self
     */
    public function remove_field( string $field_name ) {

        if ( isset( $this->{ $this->fields_var() }[ $field_name ] ) ) {
            unset( $this->{ $this->fields_var() }[ $field_name ] );
        }

        return $this;
    }

    /**
     * Set fields
     *
     * @param array $fields Fields to set.
     * @return self
     */
    public function set_fields( $fields ) {
        $this->{ $this->fields_var() } = $fields;

        return $this;
    }

    /**
     * Get fields
     *
     * @return array
     */
    public function get_fields() {
        return $this->{ $this->fields_var() };
    }

    /**
     * Get a field
     *
     * @param string $name Field name.
     * @return array
     */
    public function get_field( $name ) {
        return $this->{ $this->fields_var() }[ $name ] ?? null;
    }

    /**
     * Remove all sub fields
     *
     * @return self
     */
    public function remove_fields() {
        unset( $this->{ $this->fields_var() } );

        return $this;
    }

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param string $key  Field key.
     * @param string $name Field name (optional).
     * @return Geniem\ACF\Field
     */
    public function clone( $key, $name = null ) {
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

    /**
     * Returns current fields_var
     *
     * @return string
     */
    public function fields_var() : string {
        if ( property_exists( $this, 'sub_fields' ) ) {
            return 'sub_fields';
        }
        elseif ( property_exists( $this, 'fields' ) ) {
            return 'fields';
        }
    }
}
