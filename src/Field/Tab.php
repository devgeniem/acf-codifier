<?php
/**
 * Acf codifier tab field
 */

namespace Geniem\ACF\Field;

/**
 * Class Tab
 */
class Tab extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'tab';

    /**
     * Fields inside the tab
     *
     * @var array
     */
    protected $sub_fields;

    /**
     * Where should the tab switcher be located
     *
     * @var string
     */
    protected $placement = 'top';

    /**
     * Field endpoint
     *
     * @var integer
     */
    protected $endpoint = 0;

    /**
     * Set layout
     *
     * @throws \Geniem\ACF\Exception Throws error if layout is not valid.
     * @param string $layout New layout.
     * @return self
     */
    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: set_layout() does not accept argument "' . $layout . '"' );
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
     * Add a sub field
     *
     * @throws \Geniem\ACF\Exception Throws an error if field is not valid.
     * @param \Geniem\ACF\Field $field Field to add.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
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
    public function remove_field( $field ) {
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

    /**
     * Remove all sub fields
     *
     * @return self
     */
    public function remove_fields() {
        unset( $this->sub_fields );

        return $this;
    }

    /**
     * Set tab placement
     *
     * @throws \Geniem\ACF\Exception Throws an error if placement is not valid.
     * @param string $placement New placement.
     * @return self
     */
    public function set_placement( string $placement = 'top' ) {
        if ( ! in_array( $placement, [ 'top', 'left' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Tab: set_placement() does not accept argument "' . $placement . '"' );
        }

        $this->placement = $placement;

        return $this;
    }

    /**
     * Get placement
     *
     * @return string
     */
    public function get_placement() {
        return $this->placement;
    }

    /**
     * Enable endpoint
     *
     * @return self
     */
    public function set_endpoint() {
        $this->endpoint = 1;

        return $this;
    }

    /**
     * Disable endpoint
     *
     * @return self
     */
    public function remove_endpoint() {
        $this->endpoint = 0;

        return $this;
    }

    /**
     * Get endpoint status
     *
     * @return integer
     */
    public function get_endpoint() {
        return $this->endpoint;
    }
}
