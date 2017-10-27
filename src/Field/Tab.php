<?php
/**
 * Acf codifier tab field
 */

namespace Geniem\ACF\Field;

/**
 * Class Tab
 */
class Tab extends \Geniem\ACF\Field\GroupableField {
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
    public $sub_fields;

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
