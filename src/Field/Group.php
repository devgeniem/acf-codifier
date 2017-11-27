<?php
/**
 * Acf codifier group field
 */

namespace Geniem\ACF\Field;

/**
 * Class Group
 */
class Group extends \Geniem\ACF\Field\GroupableField {
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
     * Field variable
     *
     * @var string
     */
    protected $fields_var = 'fields';

    /**
     * Fields
     *
     * @var array
     */
    public $fields;

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
}
