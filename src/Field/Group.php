<?php
/**
 * Acf codifier group field
 */

namespace Geniem\ACF\Field;

/**
 * Class Group
 */
class Group extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'group';

    /**
     * Field layout
     *
     * @var string
     */
    protected $layout = 'block';

    /**
     * Sub fields
     *
     * @var array
     */
    protected $sub_fields;

    /**
     * Export current field and sub fields to acf compatible format
     *
     * @return array Acf fields
     */
    public function export() {
        $obj = get_object_vars( $this );

        if ( ! empty( $obj['sub_fields'] ) ) {
            $obj['sub_fields'] = array_map( function( $field ) {
                return $field->export();
            }, $obj['sub_fields'] );

            $obj['sub_fields'] = array_values( $obj['sub_fields'] );
        }

        return $obj;
    }

    /**
     * Set layout
     *
     * @throws \Geniem\ACF\Exception Throws error if layout is not valid.
     * @param string $layout New layout.
     * @return self
     */
    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Group: set_layout() does not accept argument "' . $layout . '"' );
        }

        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return string
     */
    public function get_layout() {
        return $this->layout;
    }

    /**
     * Add field to group
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Group: add_field() requires an argument that is of type "\Geniem\ACF\Field"' );
        }

        // Add the field to the fields array.
        if ( $order == 'first' ) {
            $this->sub_fields = [ $field->get_key() => $field ] + $this->sub_fields;
        }
        else {
            $this->sub_fields[ $field->get_key() ] = $field;
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
     * @param \Geniem\ACF\Field $field  A field to be added.
     * @param [string]          $action Whether it's added before or after.
     * @param [mixed]           $target A target field.
     * @return void
     */
    private function add_field_location( \Geniem\ACF\Field $field, $action, $target ) {
        // If given a field instance, replace the value with its key.
        if ( $target instanceof \ Geniem\ACF\Field ) {
            $target = $target->get_key();
        }

        // Check if the target field exists in the field group.
        if ( ! isset( $this->sub_fields[ $target ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Group: add_field_'. $action .' can\'t find given target "'. $target .'"' );
        }

        // Make a copy of the fields array to work with.
        $fields = [];

        // Loop through the fields and populate the new array.
        foreach ( $this->sub_fields as $key => $item ) {
            // If this's the spot, do the right thing.
            if ( $action === 'before' && $key === $target ) {
                $fields[ $target ] = $field;
            }

            // Insert the original inhabitant.
            $fields[ $key ] = $item;

            // And if this's the spot, do the right thing here.
            if ( $action === 'after' && $key === $target ) {
                $fields[ $target ] = $field;
            }
        }

        // Replace the original fields array with the new one.
        $this->sub_fields = $fields;

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

        return $this;
    }

    /**
     * Remove field from sub fields
     *
     * @param  integer $field Position in array.
     * @return self
     */
    public function remove_field( int $field ) {
        unset( $this->sub_fields[ $field ] );

        return $this;
    }

    /**
     * Get fields
     *
     * @return array
     */
    public function get_fields() {
        return $this->sub_fields;
    }
}
