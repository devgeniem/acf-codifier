<?php
/**
 * ACF Codifier Group class
 */

namespace Geniem\ACF;

/**
 * Class Group
 *
 * @package Geniem\ACF
 */
class Group {
    /**
     * Field group title
     *
     * @var string
     */
    protected $title;

    /**
     * Field group key
     *
     * @var string
     */
    protected $key;

    /**
     * Field group menu order value
     *
     * @var int
     */
    protected $menu_order;

    /**
     * Field group position value
     *
     * @var string
     */
    protected $position = 'normal';

    /**
     * Field group style value
     *
     * @var string
     */
    protected $style;

    /**
     * Field group label placement value
     *
     * @var string
     */
    protected $label_placement = 'top';

    /**
     * Field group instruction placement value
     *
     * @var string
     */
    protected $instruction_placement = 'label';

    /**
     * Field group hide on screen value
     *
     * @var boolean
     */
    protected $hide_on_screen;

    /**
     * Field group location rules
     *
     * @var array
     */
    protected $location;

    /**
     * Field group fields
     *
     * @var array
     */
    public $fields;

    /**
     * Field group active status
     *
     * @var boolean
     */
    protected $active;

    /**
     * Is field group registered yet
     *
     * @var boolean
     */
    protected $registered = false;

    /**
     * Field group constructor
     *
     * @param string $title Field group title.
     * @param string $key Field group key or null.
     */
    public function __construct( string $title, string $key = null ) {
        $this->title = $title;

        $this->key = $key ?? sanitize_title( $title );

        $this->active = 1;
    }

    /**
     * Prevent raw cloning
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field group.
     *
     * @param string $key  Field group key.
     * @param string $name Field group name (optional).
     * @return Geniem\ACF\Group
     */
    public function clone( string $key, string $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->reset();

        return $clone;
    }

    /**
     * Set new title for the field group.
     *
     * @param string $title Field group title.
     * @return self
     */
    public function set_title( string $title ) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get field group title.
     *
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Set new key for the field group.
     *
     * @param string $key Field group key.
     * @return self
     */
    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    /**
     * Get field group key.
     *
     * @return string
     */
    public function get_key() {
        return $this->key;
    }

    /**
     * Set field group menu order.
     *
     * @param integer $order Field group menu order value.
     * @return self
     */
    public function set_menu_order( int $order = 0 ) {
        $this->menu_order = $order;

        return $this;
    }

    /**
     * Get field group menu order.
     *
     * @return int
     */
    public function get_menu_order() {
        return $this->menu_order;
    }

    /**
     * Set field group position within the edit post screen.
     *
     * @param string $position       Field group's position value.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_position( string $position = 'normal' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $position, [ 'acf_after_title', 'normal', 'side' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_position() does not accept argument "' . $position . '"' );
        }

        $this->position = $position;

        return $this;
    }

    /**
     * Get field group position value.
     *
     * @return string
     */
    public function get_position() {
        return $this->position;
    }

    /**
     * Set field group display style.
     *
     * @param string $style Field group's style value.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_style( string $style = 'default' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $style, [ 'default', 'seamless' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_style() does not accept argument "' . $style . '"' );
        }

        $this->style = $style;

        return $this;
    }

    /**
     * Get field group display style.
     *
     * @return self
     */
    public function get_style() {
        return $this->style;
    }

    /**
     * Set field group label placement value.
     *
     * @param string $placement Field group's label placement value.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_label_placement( string $placement = 'top' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $placement, [ 'top', 'left' ], true ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_label_placement() does not accept argument "' . $placement . '"' );
        }

        $this->label_placement = $placement;

        return $this;
    }

    /**
     * Get field group label placement value.
     *
     * @return string
     */
    public function get_label_placement() {
        return $this->label_placement;
    }

    /**
     * Set field group instructions placement value.
     *
     * @param string $placement Field group's instruction placement value.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_instruction_placement( string $placement = 'label' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $placement, [ 'label', 'field' ], true ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_instruction_placement() does not accept argument "' . $placement . '"' );
        }

        $this->instruction_placement = $placement;

        return $this;
    }

    /**
     * Set elements to be hid on the post edit screen.
     *
     * @param array $elements Array of elements to hid.
     * @return self
     */
    public function set_hidden_elements( array $elements ) {
        $this->hide_on_screen = $elements;

        return $this;
    }

    /**
     * Get hidden elements.
     *
     * @return array
     */
    public function get_hidden_elements() {
        return $this->hide_on_screen;
    }

    /**
     * Set an element to be hid on the edit post screen.
     *
     * @param string $element Name of the element to be hid.
     * @return self
     */
    public function hide_element( string $element ) {
        $this->hide_on_screen[] = $element;

        // Ensure that all elements are in the array only once.
        $this->hide_on_screen = array_unique( $this->hide_on_screen );

        return $this;
    }

    /**
     * Show previously hidden element on the edit post screen.
     *
     * @param string $element Name of the element to be shown.
     * @return self
     */
    public function show_element( string $element ) {
        $position = array_search( $element, $this->hide_on_screen, true );

        if ( ( $position !== false ) ) {
            unset( $this->hide_on_screen[ $position ] );
        }

        return $this;
    }

    /**
     * Add a location rule group for the field group.
     *
     * @param \Geniem\ACF\RuleGroup $group Rule group to be added.
     * @return self
     */
    public function add_rule_group( \Geniem\ACF\RuleGroup $group ) {
        $rules = $group->get_rules();

        if ( count( $rules ) > 0 ) {
            $this->location[] = $rules;
        }

        return $this;
    }

    /**
     * Get all rule groups that have been added for the field group.
     *
     * @return array
     */
    public function get_rule_groups() {
        return $this->location;
    }

    /**
     * Add a field to the field group.
     *
     * @param \Geniem\ACF\Field $field A field to be added.
     * @param string            $order Whether the field is added first or last.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field, $order = 'last' ) {
        // Add the field to the fields array.
        if ( $order === 'first' ) {
            $this->fields = [ $field->get_key() => $field ] + $this->fields;
        }
        else {
            $this->fields[ $field->get_key() ] = $field;
        }

        // If the field group has already been registered, do things the ACF way.
        if ( $this->registered ) {
            if ( function_exists( 'acf_add_local_field' ) ) {
                $exported = $field->export();

                $exported['parent'] = $this->key;

                \acf_add_local_field( $exported );
            }
        }

        return $this;
    }

    /**
     * Add a field to the field group before a target field.
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
     * Add a field to the field group after a target field.
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
        if ( $target instanceof \Geniem\ACF\Field ) {
            $target = $target->get_key();
        }

        // Check if the target field exists in the field group.
        if ( ! isset( $this->fields[ $target ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field: add_field_' . $action . ' can\'t find given target "' . $target . '"' );
        }

        // Make a copy of the fields array to work with.
        $fields = [];

        // Loop through the fields and populate the new array.
        foreach ( $this->fields as $key => $item ) {
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
        $this->fields = $fields;

        return $this;
    }

    /**
     * Remove a field from the field group.
     *
     * @param string $key The name of the field to be removed.
     * @return self
     */
    public function remove_field( string $key ) {
        // If the field group has already been registered, do things the ACF way.
        if ( $this->registered ) {
            if ( function_exists( 'acf_remove_local_field' ) ) {
                \acf_remove_local_field( $key );
            }
        }

        // Otherwise just remove it from the array.
        if ( isset( $this->fields[ $key ] ) ) {
            unset( $this->fields[ $key ] );
        }

        return $this;
    }

    /**
     * Get a field by its key.
     *
     * @param string $key The key of the field to be fetched.
     * @return \Geniem\ACF\Field
     */
    public function get_field( string $key ) {
        return $this->fields[ $key ];
    }

    /**
     * Get all fields from the field group.
     *
     * @return array
     */
    public function get_fields() {
        return $this->fields;
    }

    /**
     * Export fields in the ACF format.
     *
     * @return array
     */
    public function export_fields() {
        // Loop through fields and return their export method.
        return array_map( function( $field ) {
            return $field->export();
        }, $this->fields );
    }

    /**
     * Change the field group's status as active.
     *
     * @return self
     */
    public function activate() {
        $this->active = 1;

        return $this;
    }

    /**
     * Change the field group's status as not active.
     *
     * @return self
     */
    public function deactivate() {
        $this->active = 0;

        return $this;
    }

    /**
     * Register the field group to ACF.
     *
     * @return void
     */
    public function register() {
        if ( function_exists( 'acf_add_local_field_group' ) ) {
            $element = $this;

            \add_action( 'wp_loaded', function() use ( $element ) {
                $exported = $element->export( true );

                \acf_add_local_field_group( $exported );
            });

            $this->registered = true;
        }
    }

    /**
     * Reset the field group's registered status.
     *
     * @return void
     */
    public function reset() {
        $this->registered = false;
    }

    /**
     * Export current field and sub fields to acf compatible format
     *
     * @param boolean $register Whether the field group is to be registered.
     *
     * @return array Acf fields
     */
    public function export( $register = false ) {
        if ( $register && ! empty( $this->filters ) ) {
            array_walk( $this->filters, function( $filter ) {
                $filter = wp_parse_args( $filter, $this->default_filter_arguments );
                add_filter( $filter['filter'] . $this->key, $filter['function'], $filter['priority'], $filter['accepted_args'] );
            });
        }

        if ( $register && $this->hide_label ) {
            \Geniem\ACF\Codifier::hide_label( $this );
        }

        $obj = get_object_vars( $this );

        // Remove unnecessary properties from the exported array.
        unset( $obj['inheritee'] );
        unset( $obj['groupable'] );
        unset( $obj['fields_var'] );

        // Loop through fields and export them.
        if ( ! empty( $obj['fields'] ) ) {
            $fields = [];

            foreach ( $obj['fields'] as $field ) {
                if ( $field instanceof \Geniem\ACF\Field\PseudoGroupableField ) {
                    // Get the subfields
                    $sub_fields = $field->get_fields();
                }

                $fields[] = $field->export( $register );

                // Add the possibly stored subfields
                if ( ! empty( $sub_fields ) ) {
                    $exported_sub_fields = self::export_sub_fields( $sub_fields, $register );

                    $fields = array_merge( $fields, $exported_sub_fields );

                    unset( $sub_fields );
                }
            }

            // Remove keys, ACF requires the arrays to be numbered.
            $obj['fields'] = array_filter( array_values( $fields ) );
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
    private static function export_sub_fields( array $fields, $register ) {
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
                $exported_sub_fields = self::export_sub_fields( $sub_fields, $register );

                $return = array_merge( $return, $exported_sub_fields );
            }
        }

        return $return;
    }
}
