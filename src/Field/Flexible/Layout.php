<?php
namespace Geniem\ACF\Field\Flexible;

class Layout {
    protected $label;

    protected $key;

    protected $name;

    protected $subfields;

    protected $display = 'block';

    public function __construct( string $label ) {
        $this->label = $label;

        $this->key = sanitize_title( $label );

        $this->name = sanitize_title( $label );

        $this->active = 1;
    }

    private function __clone() {}

    public function clone( $key, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->reset();

        return $clone;
    }

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

    public function add_field( $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new Exception( 'Geniem\ACF\Group: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
        }

        $this->sub_fields[ $field->get_name() ] = $field;

        return $this;
    }

    public function remove_field( $name ) {
        if ( isset( $this->sub_fields[ $name ] ) ) {
            unset( $this->sub_fields[ $name ] );
        }

        return $this;
    }

    public function get_field( $name ) {
        return $this->subfields[ $name ];
    }

    public function get_fields() {
        return $this->subfields;
    }

    public function set_display_mode( string $display_mode = 'block' ) {
        if ( ! in_array( $display_mode, [ 'block', 'table', 'row' ] ) ) {
            throw new Exception ('Geniem\ACF\FlexibleLayout: set_display_mode() does not accept argument "' . $display_mode .'"' );
        }

        $this->display = $display_mode;

        return $this;
    }
}
