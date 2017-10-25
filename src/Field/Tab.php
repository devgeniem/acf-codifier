<?php
/**
 * Acf codifier tab field
 */

namespace Geniem\ACF\Field;

/**
 * Class Tab
 */
class Tab extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'tab';

    /**
     * Fields inside the tab
     *
     * @var array
     */
    protected $sub_fields;

    /**
     * Where should the tab switcher be located
     *
     * @var string
     */
    protected $placement = 'top';

    /**
     * Field endpoint
     *
     * @var integer
     */
    protected $endpoint = 0;

    /**
     * Set layout
     *
     * @throws \Geniem\ACF\Exception Throws error if layout is not valid.
     * @param string $layout New layout.
     * @return self
     */
    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: set_layout() does not accept argument "' . $layout . '"' );
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
     * Add field to tab
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: add_field() requires an argument that is of type "\Geniem\ACF\Field"' );
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
     * Add a field to the tab before a target field.
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
     * Add a field to the tab after a target field.
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
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: add_field_'. $action .' can\'t find given target "'. $target .'"' );
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
    public function remove_field( $field ) {
        unset( $this->sub_fields[ $field ] );

        return $this;
    }

    /**
     * Set fields
     * 
     * @param array $fields Fields to set.
     * @return self
     */
    public function set_fields( $fields ) {
        $this->sub_fields = $fields;
    }

    /**
     * Get fields
     *
     * @return array
     */
    public function get_fields() {
        return $this->sub_fields;
    }

    /**
     * Remove all sub fields
     *
     * @return self
     */
    public function remove_fields() {
        unset( $this->sub_fields );

        return $this;
    }

    /**
     * Set tab placement
     *
     * @throws \Geniem\ACF\Exception Throws an error if placement is not valid.
     * @param string $placement New placement.
     * @return self
     */
    public function set_placement( string $placement = 'top' ) {
        if ( ! in_array( $placement, [ 'top', 'left' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: set_placement() does not accept argument "' . $placement . '"' );
        }

        $this->placement = $placement;

        return $this;
    }

    /**
     * Get placement
     *
     * @return string
     */
    public function get_placement() {
        return $this->placement;
    }

    /**
     * Enable endpoint
     *
     * @return self
     */
    public function set_endpoint() {
        $this->endpoint = 1;

        return $this;
    }

    /**
     * Disable endpoint
     *
     * @return self
     */
    public function remove_endpoint() {
        $this->endpoint = 0;

        return $this;
    }

    /**
     * Get endpoint status
     *
     * @return integer
     */
    public function get_endpoint() {
        return $this->endpoint;
    }
}
