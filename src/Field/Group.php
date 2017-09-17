<?php
namespace Geniem\ACF\Field;

class Group extends \Geniem\ACF\Field {
    protected $type = 'group';

    protected $layout = 'block';

    protected $sub_fields;

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

    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new Exception ('Geniem\ACF\Field\Group: set_layout() does not accept argument "' . $layout .'"' );
        }

        $this->layout = $layout;

        return $this;
    }

    public function get_layout() {
        return $this->layout;
    }

    public function add_field( $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new Exception ('Geniem\ACF\Field\Group: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
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
