<?php
/**
 * Acf codifier repeater field
 */

namespace Geniem\ACF\Field;

/**
 * Class Repeater
 */
class Repeater extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'repeater';

    /**
     * What sub field should be shown when collapsed
     *
     * @var string Field key
     */
    protected $collapsed;

    /**
     * Minimum amount of flexible layouts to add
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum amount of flexible layouts to add
     *
     * @var integer
     */
    protected $max;

    /**
     * Field layout
     *
     * @var string
     */
    protected $layout;

    /**
     * Add row button text
     *
     * @var string
     */
    protected $button_label;

    /**
     * Repeater fields
     *
     * @var array
     */
    protected $sub_fields;

    /**
     * Override field construction method to add default button label but run parent constructor after that
     *
     * @param string $label Field label.
     */
    public function __construct( $label ) {
        $this->button_label = __( 'Add Row', 'acf' );

        parent::__construct( $label );
    }

    /**
     * Export field in ACF's native format.
     * This also exports sub fields
     *
     * @return array
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
     * Set maximum amount of layouts
     *
     * @param integer $max Maximum amount.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum amount of layouts
     *
     * @return integer Maximum amount
     */
    public function get_max() {
        return $this->max;
    }

    /**
     * Set minimum amount of layouts
     *
     * @param integer $min Minimum amount.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum amount of layouts
     *
     * @return integer Minimum amount
     */
    public function get_min() {
        return $this->min;
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
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Repeater: set_layout() does not accept argument "' . $layout . '"' );
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
     * Set add row button label
     *
     * @param string $button_label Text to show inside button.
     * @return self
     */
    public function set_button_label( string $button_label ) {
        $this->button_label = $button_label;

        return $this;
    }

    /**
     * Get button label
     *
     * @return string Button label
     */
    public function get_button_label() {
        return $this->button_label;
    }

    /**
     * Add field to the repeater
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Repeater: add_field() requires an argument that is of type "\Geniem\ACF\Field"' );
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
     * Add a field to the repeater before a target field.
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
     * Add a field to the repeater after a target field.
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
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Repeater: add_field_'. $action .' can\'t find given target "'. $target .'"' );
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
