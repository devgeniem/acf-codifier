<?php
/**
 * Acf codifier group field
 */

namespace Geniem\ACF\Field;

/**
 * Class Group
 */
class Group extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'group';

    /**
     * Field layout
     *
     * @var string
     */
    protected $layout = 'block';

    /**
     * Sub fields
     *
     * @var array
     */
    protected $sub_fields;

    /**
     * Export current field and sub fields to acf compatible format
     *
     * @return array Acf fields
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
     * Set layout
     *
     * @throws \Geniem\ACF\Exception Throws error if layout is not valid.
     * @param string $layout New layout.
     * @return self
     */
    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Group: set_layout() does not accept argument "' . $layout . '"' );
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
     * Add field to group
     *
     * @throws \Geniem\ACF\Exception Throws an error if field is not valid.
     * @param \Geniem\ACF\Field $field Field to add.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Group: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
        }

        $this->sub_fields[] = $field;

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
