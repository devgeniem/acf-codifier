<?php
namespace Geniem\ACF\Field;

class Repeater extends \Geniem\ACF\Field {
    protected $type = 'repeater';

    protected $collapsed;

    protected $min;

    protected $max;

    protected $layout;

    protected $button_label;

    protected $sub_fields;

    public function __construct( $label ) {
        $this->button_label = __( 'Add Row', 'acf' );

        parent::__construct( $label );
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

    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    public function get_min() {
        return $this->min;
    }

    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    public function get_max() {
        return $this->max;
    }

    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new Exception ('Geniem\ACF\Field\Repeater: set_layout() does not accept argument "' . $layout .'"' );
        }

        $this->layout = $layout;

        return $this;
    }

    public function get_layout() {
        return $this->layout;
    }

    public function set_button_label( string $button_label ) {
        $this->button_label = $button_label;

        return $this;
    }

    public function get_button_label() {
        return $this->button_label;
    }

    public function add_field( $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new Exception ('Geniem\ACF\Field\Repeater: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
        }

        $this->sub_fields[] = $field;

        return $this;
    }

    public function remove_field( $field ) {
        unset( $this->sub_fields[ $field ] );

        return $this;
    }

    public function get_fields() {
        return $this->sub_fields;
    }
}
