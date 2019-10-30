<?php
/**
 * ACF codifier accordion field
 */

namespace Geniem\ACF\Field;

/**
 * Class Accordion
 */
class Accordion extends GroupableField implements PseudoGroupableField {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'accordion';

    /**
     * Fields inside the tab
     *
     * @var array
     */
    public $sub_fields = [];

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
     * Whether or not the accordion is multi-expandable
     *
     * @var integer
     */
    protected $multi_expand = 0;

    /**
     * Whether or not the panel is open on page load
     *
     * @var integer
     */
    protected $open = 0;

    /**
     * Tab doesn't need a key.
     *
     * @var boolean
     */
    public $no_key = true;

    /**
     * Export field in ACF's native format.
     *
     * @param boolean $register Whether the field is to be registered.
     *
     * @return array
     */
    public function export( bool $register = false ) : ?array {
        $obj = parent::export( $register );

        // Make the key unique so that it can't collide with others. This is only used in
        // the conditional logic feature so it can change on every page load.
        $obj['key'] = 'tab_' . $obj['key'] . '_' . uniqid( '', true );

        if ( method_exists( $this, 'fields_var' ) ) {
            // Remove the subfields from the export object.
            unset( $obj[ $this->fields_var() ] );
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

    /**
     * Enable multi expand
     *
     * @return self
     */
    public function set_multi_expand() {
        $this->multi_expand = 1;

        return $this;
    }

    /**
     * Disable multi expand
     *
     * @return self
     */
    public function remove_multi_expand() {
        $this->multi_expand = 0;

        return $this;
    }

    /**
     * Get multi expand status
     *
     * @return integer
     */
    public function get_multi_expand() {
        return $this->multi_expand;
    }

    /**
     * Enable opening on page load
     *
     * @return self
     */
    public function set_open() {
        $this->open = 1;

        return $this;
    }

    /**
     * Disable open on page load
     *
     * @return self
     */
    public function remove_open() {
        $this->open = 0;

        return $this;
    }

    /**
     * Get open status
     *
     * @return integer
     */
    public function get_open() {
        return $this->open;
    }
}
