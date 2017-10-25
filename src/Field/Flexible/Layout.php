<?php
/**
 * Layout class for the flexible field
 */

namespace Geniem\ACF\Field\Flexible;

/**
 * Class Layout
 */
class Layout {
    /**
     * Layout label
     *
     * @var string
     */
    protected $label;

    /**
     * Layout key
     *
     * @var string
     */
    protected $key;

    /**
     * Layout name
     *
     * @var string
     */
    protected $name;

    /**
     * Layout subfields
     *
     * @var array
     */
    protected $subfields;

    /**
     * Display mode
     *
     * @var string
     */
    protected $display = 'block';

    /**
     * Constructor
     *
     * @param string      $label Layout label.
     * @param string|null $key   Layout key.
     * @param string|null $name  Layout name.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        $this->label = $label;

        $this->key = $key ?? sanitize_title( $label );

        $this->name = $name ?? sanitize_title( $label );

        $this->active = 1;
    }

    /**
     * Prevent raw cloning.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param  string      $key  New field key.
     * @param  string|null $name New field name.
     * @return Geniem\ACF\Field
     */
    public function clone( $key, string $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->reset();

        return $clone;
    }

    /**
     * Export field in ACF's native format.
     *
     * @return array Exported acf compatible version
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
     * Set label
     *
     * @param string $label New label.
     * @return self
     */
    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string Label
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Set key
     *
     * @param string $key New key.
     * @return self
     */
    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string Key
     */
    public function get_key() {
        return $this->key;
    }

    /**
     * Set name
     *
     * @param string $name New name.
     * @return self
     */
    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string Name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Add field to layout
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Flexible\Layout: add_field() requires an argument that is of type "\Geniem\ACF\Field"' );
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
     * Add a field to the layout before a target field.
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
     * Add a field to the layout after a target field.
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
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Flexible\Layout: add_field_'. $action .' can\'t find given target "'. $target .'"' );
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
     * @param  string $name Field name.
     * @return self
     */
    public function remove_field( string $name ) {
        if ( isset( $this->sub_fields[ $name ] ) ) {
            unset( $this->sub_fields[ $name ] );
        }

        return $this;
    }

    /**
     * Get sub field by name
     *
     * @param  string $name Field name.
     * @return \Geniem\ACF\Field $name Field name.
     */
    public function get_field( string $name ) {
        return $this->subfields[ $name ];
    }

    /**
     * Get all sub fields
     *
     * @return array Fields
     */
    public function get_fields() {
        return $this->subfields;
    }

    /**
     * Set display mode
     *
     * @param string $display_mode Display mode to set.
     * @throws \Geniem\ACF\Field Info about invalid display mode.
     * @return self
     */
    public function set_display_mode( string $display_mode = 'block' ) {
        if ( ! in_array( $display_mode, [ 'block', 'table', 'row' ] ) ) {
            throw new \Geniem\ACF\Field( 'Geniem\ACF\FlexibleLayout: set_display_mode() does not accept argument "' . $display_mode . '"' );
        }

        $this->display = $display_mode;

        return $this;
    }
}
