<?php
/**
 * ACF Codifier Groupable group abstract class
 */

namespace Geniem\ACF\Field;

/**
 * Groupable Class
 */
class Groupable {
    /**
     * Instance of the class that inherited Groupable.
     *
     * @var mixed
     */
    protected $inheritee;

    /**
     * Variable name for the fields storage
     *
     * @var string
     */
    protected $fields_var = 'fields';

    /**
     * Either inheritee or $this
     *
     * @var mixed
     */
    private $self;

    /**
     * Constructor.
     *
     * @param mixed $inheritee Instance of the class that inherited this class.
     */
    public function __construct( $inheritee = null ) {
        // Save the inheritee class into its property.
        $this->inheritee = $inheritee;

        if ( isset( $this->inheritee ) && property_exists( $this->inheritee, 'sub_fields' ) ) {
            $this->fields_var = 'sub_fields';
        }
        else {
            $this->fields_var = 'fields';
        }

        $this->self = $this->inheritee ?? $this;
    }

    /**
     * __get
     * 
     * Reference allows the referenced property to be modified through
     * the call.
     *
     * @param string $name Name of the property to get.
     * @return mixed
     */
    public function &__get( $name ) {
        // Return inheritee's property with the asked name.
        return $this->inheritee->{ $name };
    }

    /**
     * Export current field and sub fields to acf compatible format
     *
     * @param boolean $register Whether the field is to be registered.
     *
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
            $obj[ $this->fields_var ] = array_map( function( $field ) use ( $register ) {
                return $field->export( $register );
            }, $obj[ $this->fields_var ] );

            // Remove keys, ACF requires the arrays to be numbered.
            $obj[ $this->fields_var ] = array_values( $obj[ $this->fields_var ] );
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
     * Add field to group
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @param string            $order Whether the field is to be added first or last.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        // Special treatment if the field to be added is a tab.
        if ( $field instanceof \Geniem\ACF\Field\Tab ) {
            // Save the subfields from the tab...
            $sub_fields = $field->get_fields();

            // ...and take them away from their original mother.
            $field->remove_fields();
        }

        // Add the field to the fields array.
        if ( $order === 'first' ) {
            $this->{ $this->fields_var } = [ $field->get_key() => $field ] + $this->{ $this->fields_var };
        }
        else {
            $this->{ $this->fields_var }[ $field->get_key() ] = $field;
        }

        // If we have stored subfields from a tab, add them one by one separately.
        if ( ! empty( $sub_fields ) ) {
            foreach ( $sub_fields as $sub_field ) {
                $this->add_field( $sub_field );
            }

            // Return subfields to the original field instance for possible later use
            $field->set_fields( $sub_fields );
        }

        return $this->self;
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
     * @param \Geniem\ACF\Field $field  A field to be added.
     * @param [string]          $action Whether it's added before or after.
     * @param [mixed]           $target A target field.
     * @return self
     */
    private function add_field_location( \Geniem\ACF\Field $field, $action, $target ) {
        // If given a field instance, replace the value with its key.
        if ( $target instanceof \ Geniem\ACF\Field ) {
            $target = $target->get_key();
        }

        // Check if the target field exists in the field group.
        if ( ! isset( $this->{ $this->fields_var }[ $target ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Group: add_field_'. $action .' can\'t find given target "'. $target .'"' );
        }

        // Make a copy of the fields array to work with.
        $fields = [];

        // Loop through the fields and populate the new array.
        foreach ( $this->{ $this->fields_var } as $key => $item ) {

            // If this's the spot, do the right thing.
            if ( $action === 'before' && $key === $target ) {
                $fields[ $field->get_name() ] = $field;
            }

            // Insert the original inhabitant.
            $fields[ $key ] = $item;

            // And if this's the spot, do the right thing here.
            if ( $action === 'after' && $key === $target ) {
                $fields[ $field->get_name() ] = $field;
            }
        }

        // Replace the original fields array with the new one.
        $this->{ $this->fields_var } = $fields;

        // Special treatment if the field to be added is a tab.
        if ( $field instanceof \ Geniem\ACF\Field\Tab ) {
            // Save the subfields from the tab...
            $sub_fields = $field->get_fields();

            // ...and take them away from their original mother.
            $field->remove_fields();
        }

        // If we have stored subfields from a tab, add them one by one separately.
        if ( ! empty( $sub_fields ) ) {
            foreach ( $sub_fields as $sub_field ) {
                $this->add_field( $sub_field );
            }

            // Return subfields to the original field instance for possible later use
            $field->set_fields( $sub_fields );
        }

        return $this->self;
    }

    /**
     * Remove field from sub fields
     *
     * @param  string $field Name of the field to remove.
     * @return self
     */
    public function remove_field( string $field_name ) {

        if ( isset( $this->{ $this->fields_var }[ $field_name ] ) ) {
            unset( $this->{ $this->fields_var }[ $field_name ] );
        }

        return $this->self;
    }

    /**
     * Set fields
     *
     * @param array $fields Fields to set.
     * @return self
     */
    public function set_fields( $fields ) {
        $this->sub_fields = $fields;

        return $this->self;
    }

    /**
     * Get fields
     *
     * @return array
     */
    public function get_fields() {
        return $this->{ $this->fields_var };
    }

    /**
     * Get a field
     *
     * @param string $key Field's key.
     * @return array
     */
    public function get_field( $key ) {
        return $this->{ $this->fields_var }[ $key ] ?? null;
    }

    /**
     * Remove all sub fields
     *
     * @return self
     */
    public function remove_fields() {
        unset( $this->sub_fields );

        return $this->self;
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

        $clone->{ $this->fields_var } = array_map( function( $field ) use ( $key ) {
            return $field->clone( $key . '_' . $field->get_key() );
        }, $clone->{ $this->fields_var });

        return $clone;
    }
}
