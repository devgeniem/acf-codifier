<?php
namespace Geniem\ACF;

class Field {
    protected $label;

    protected $key;

    protected $name;

    protected $instructions;

    protected $required;

    protected $conditional_logic;

    protected $default_value;

    public function __construct( string $label ) {
        if ( ! isset( $this->type ) ) {
            throw new Exception( 'Geniem\ACF\Field: the extending class must have property "type"' );
        }

        $this->label = $label;

        $this->key = sanitize_title( $label );

        $this->name = sanitize_title( $label );

        $this->wrapper = [
            'width' => '',
            'class' => '',
            'id' => ''
        ];
    }

    private function __clone() {}

    public function clone( $key, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        return $clone;
    }

    public function export() {
        $obj = get_object_vars( $this );

        if ( isset( $obj['wrapper']['class'] ) && ! empty( $obj['wrapper']['class'] ) ) {
            $obj['wrapper']['class'] = implode( ' ', $obj['wrapper']['class'] );
        }

        return $obj;
    }

    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    public function get_label() {
        return $this->label;
    }

    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    public function get_key() {
        return $this->key;
    }

    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_type() {
        return $this->type;
    }

    public function set_instructions( string $instructions ) {
        $this->instructions = $instructions;

        return $this;
    }

    public function get_instructions() {
        return $this->instructions;
    }

    public function set_required() {
        $this->required = 1;

        return $this;
    }

    public function set_unrequired() {
        $this->required = 0;

        return $this;
    }

    public function get_required() {
        return (boolean) $this->required;
    }

    public function add_conditional_logic( \Geniem\ACF\ConditionalLogicGroup $group ) {
        $rules = $group->get_rules();

        if ( count( $rules ) > 0 ) {
            $this->conditional_logic[] = $rules;
        }

        return $this;
    }

    public function get_conditional_logic() {
        return $this->conditional_logic;
    }

    public function set_wrapper_width( int $width ) {
        $this->wrapper['width'] = $width;

        return $this;
    }

    public function get_wrapper_width() {
        return $this->wrapper['width'];
    }

    public function set_wrapper_classes( $classes ) {
        if ( is_string( $classes ) ) {
            $this->wrapper['class'] = explode( ' ', $classes );
        }
        else if ( is_array( $classes ) ) {
            $this->wrapper['class'] = $classes;
        }
        else {
            throw new Exception( 'Geniem\ACF\Field: set_wrapper_classes() argument must be an array or a string' );
        }

        return $this;
    }

    public function add_wrapper_class( string $class ) {
        $this->wrapper['class'][] = $class;

        return $this;
    }

    public function remove_wrapper_class( string $class ) {
        $position = array_search( $class, $this->wrapper['class'] );

        if ( ( $position !== false ) ) {
            unset( $this->wrapper['class'][ $position ] );
        }

        return $this;
    }

    public function get_wrapper_classes() {
        return $this->wrapper['class'];
    }

    public function set_wrapper_id( string $id ) {
        $this->wrapper['id'] = $id;

        return $this;
    }

    public function get_wrapper_id() {
        return $this->wrapper['id'];
    }

    public function set_default_value( string $value ) {
        $this->default_value = $value;

        return $this;
    }

    public function get_default_value() {
        return $this->default_value;
    }
}
