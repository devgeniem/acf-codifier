<?php
/**
 * ACF Codifier Field class
 */

namespace Geniem\ACF;

/**
 * Class Field
 */
abstract class Field {
    /**
     * Field label.
     *
     * @var string
     */
    protected $label;

    /**
     * Field key.
     *
     * @var string
     */
    protected $key;

    /**
     * Field name.
     *
     * @var string
     */
    protected $name;

    /**
     * Field instructions.
     *
     * @var string
     */
    protected $instructions;

    /**
     * Field required status.
     *
     * @var boolean
     */
    protected $required = 0;

    /**
     * Conditional logic attached to the field.
     *
     * @var array
     */
    protected $conditional_logic;

    /**
     * Default value for the field.
     *
     * @var mixed
     */
    protected $default_value;

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     */
    public function __construct( string $label, string $key = null, string $name = null  ) {
        // Force the inheriting class to have a property type.
        if ( ! isset( $this->type ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field: the extending class must have property "type"' );
        }

        $this->label = $label;

        $this->key = $key ?? sanitize_title( $label );

        $this->name = $name ?? sanitize_title( $label );

        $this->wrapper = [
            'width' => '',
            'class' => '',
            'id' => '',
        ];
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

        return $clone;
    }

    /**
     * Export field in ACF's native format.
     *
     * @return array
     */
    public function export() {
        $obj = get_object_vars( $this );

        unset( $obj['inheritee'] );
        unset( $obj['groupable'] );
        unset( $obj['fields_var'] );

        if ( \property_exists( $this, 'fields_var' ) && ! empty( $obj[ $this->fields_var ] ) ) {
            $obj[ $this->fields_var ] = array_map( function( $field ) {
                return $field->export();
            }, $obj[ $this->fields_var ] );

            $obj[ $this->fields_var ] = array_values( $obj[ $this->fields_var ] );
        }

        // Convert the wrapper class array to a space-separated string.
        if ( isset( $obj['wrapper']['class'] ) && ! empty( $obj['wrapper']['class'] ) ) {
            $obj['wrapper']['class'] = implode( ' ', $obj['wrapper']['class'] );
        }

        return $obj;
    }

    /**
     * Set label for the field.
     *
     * @param string $label Label to be set.
     * @return self
     */
    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the label of the field.
     *
     * @return string
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Set key for the field.
     *
     * @param string $key Key to be set.
     * @return self
     */
    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the key of the field.
     *
     * @return string
     */
    public function get_key() {
        return $this->key;
    }

    /**
     * Set name for the field.
     *
     * @param string $name Name to be set.
     * @return self
     */
    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the name of the field.
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Get the type of the field.
     *
     * @return string
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * Set instruction text for the field.
     *
     * @param string $instructions Instructions.
     * @return self
     */
    public function set_instructions( string $instructions ) {
        $this->instructions = $instructions;

        return $this;
    }

    /**
     * Get the instruction text of the field.
     *
     * @return string
     */
    public function get_instructions() {
        return $this->instructions;
    }

    /**
     * Set the field to be required.
     *
     * @return self
     */
    public function set_required() {
        $this->required = 1;

        return $this;
    }

    /**
     * Set the field to be unrequired.
     *
     * @return self
     */
    public function set_unrequired() {
        $this->required = 0;

        return $this;
    }

    /**
     * Get the required status of the field.
     *
     * @return boolean
     */
    public function get_required() {
        return (boolean) $this->required;
    }

    /**
     * Add a conditional logic for the field.
     *
     * @param \Geniem\ACF\ConditionalLogicGroup $group The conditional logic group to be added.
     * @return self
     */
    public function add_conditional_logic( \Geniem\ACF\ConditionalLogicGroup $group ) {
        $rules = $group->get_rules();

        if ( count( $rules ) > 0 ) {
            $this->conditional_logic[] = $rules;
        }

        return $this;
    }

    /**
     * Get the conditional logic group that have been added to the group.
     *
     * @return \Geniem\ACF\ConditionalLogicGroup
     */
    public function get_conditional_logic() {
        return $this->conditional_logic;
    }

    /**
     * Set the wrapper width in percents.
     *
     * @param integer $width Width to be set.
     * @return self
     */
    public function set_wrapper_width( int $width ) {
        $this->wrapper['width'] = $width;

        return $this;
    }

    /**
     * Get the wrapper width.
     *
     * @return int
     */
    public function get_wrapper_width() {
        return $this->wrapper['width'];
    }

    /**
     * Set classes to be added for the field.
     *
     * @param mixed $classes The classes to be added either as an array or as a space-separated string.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     * @return self
     */
    public function set_wrapper_classes( $classes ) {
        if ( is_string( $classes ) ) {
            $this->wrapper['class'] = explode( ' ', $classes );
        } else if ( is_array( $classes ) ) {
            $this->wrapper['class'] = $classes;
        } else {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field: set_wrapper_classes() argument must be an array or a string' );
        }

        return $this;
    }

    /**
     * Add a single wrapper class to be added for the field.
     *
     * @param string $class Class to be added.
     * @return self
     */
    public function add_wrapper_class( string $class ) {
        $this->wrapper['class'][] = $class;

        return $this;
    }

    /**
     * Remove a single wrapper class from the field.
     *
     * @param string $class Class to be removed.
     * @return self
     */
    public function remove_wrapper_class( string $class ) {
        $position = array_search( $class, $this->wrapper['class'] );

        if ( ( $position !== false ) ) {
            unset( $this->wrapper['class'][ $position ] );
        }

        return $this;
    }

    /**
     * Get all wrapper classes that have been added for the field.
     *
     * @return array
     */
    public function get_wrapper_classes() {
        return $this->wrapper['class'];
    }

    /**
     * Add a wrapper id for the field.
     *
     * @param string $id Id to be added.
     * @return self
     */
    public function set_wrapper_id( string $id ) {
        $this->wrapper['id'] = $id;

        return $this;
    }

    /**
     * Get the id that has been added for the field.
     *
     * @return string
     */
    public function get_wrapper_id() {
        return $this->wrapper['id'];
    }

    /**
     * Set the default value for the field.
     *
     * @param mixed $value The default value.
     * @return self
     */
    public function set_default_value( $value ) {
        $this->default_value = $value;

        return $this;
    }

    /**
     * Get the default value of the field.
     *
     * @return mixed
     */
    public function get_default_value() {
        return $this->default_value;
    }
}
