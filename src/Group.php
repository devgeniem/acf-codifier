<?php
/**
 * ACF Codifier Group class
 */

namespace Geniem\ACF;

use Geniem\ACF\Field\Common\Groupable,
    Geniem\ACF\Exception as Exception,
    Geniem\ACF\Field\PseudoGroupableField as PseudoGroupableField;

/**
 * Class Group
 *
 * @package Geniem\ACF
 */
class Group {

    /**
     * Import the groupable functionalities
     */
    use Groupable;

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
    public $fields = [];

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

        $this->key = $key;

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
     * @throws Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_position( string $position = 'normal' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $position, [ 'acf_after_title', 'normal', 'side' ] ) ) {
            throw new Exception( 'Geniem\ACF\Group: set_position() does not accept argument "' . $position . '"' );
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
     * @throws Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_style( string $style = 'default' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $style, [ 'default', 'seamless' ] ) ) {
            throw new Exception( 'Geniem\ACF\Group: set_style() does not accept argument "' . $style . '"' );
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
     * @throws Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_label_placement( string $placement = 'top' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $placement, [ 'top', 'left' ], true ) ) {
            throw new Exception( 'Geniem\ACF\Group: set_label_placement() does not accept argument "' . $placement . '"' );
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
     * @throws Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_instruction_placement( string $placement = 'label' ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $placement, [ 'label', 'field' ], true ) ) {
            throw new Exception( 'Geniem\ACF\Group: set_instruction_placement() does not accept argument "' . $placement . '"' );
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
     * @param Field $field A field to be added.
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
            \add_action( 'wp_loaded', function() {
                $exported = $this->export( true );

                \acf_add_local_field_group( $exported );

                $this->registered = true;
            });
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
     * @param mixed   $parent   Possible parent object.
     *
     * @throws Exception Throws an exception if a key is not defined.
     *
     * @return array Acf fields
     */
    public function export( $register = false, $parent = null ) {
        if ( empty( $this->key ) ) {
            throw new Exception( 'Field group ' . $this->label . ' does not have a key defined.' );
        }

        $obj = get_object_vars( $this );

        // Remove unnecessary properties from the exported array.
        unset( $obj['fields_var'] );

        // Loop through fields and export them.
        if ( ! empty( $obj['fields'] ) ) {
            $fields = [];

            foreach ( $obj['fields'] as $field ) {
                if ( $field instanceof PseudoGroupableField ) {
                    // Get the subfields
                    $sub_fields = $field->get_fields();
                }

                $fields[] = $field->export( $register, $this );

                // Add the possibly stored subfields
                if ( ! empty( $sub_fields ) ) {
                    $exported_sub_fields = $this->export_sub_fields( $sub_fields, $register, $this );

                    $fields = array_merge( $fields, $exported_sub_fields );

                    unset( $sub_fields );
                }
            }

            // Remove keys, ACF requires the arrays to be numbered.
            $obj['fields'] = array_filter( array_values( $fields ) );
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
}
