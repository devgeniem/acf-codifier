<?php
/**
 * Acf codifier repeater field
 */

namespace Geniem\ACF\Field;

/**
 * Class Repeater
 */
class Repeater extends \Geniem\ACF\Field\GroupableField {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'repeater';

    /**
     * What sub field should be shown when collapsed
     *
     * @var string Field key
     */
    protected $collapsed;

    /**
     * Minimum amount of flexible layouts to add
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum amount of flexible layouts to add
     *
     * @var integer
     */
    protected $max;

    /**
     * Field layout
     *
     * @var string
     */
    protected $layout;

    /**
     * Add row button text
     *
     * @var string
     */
    protected $button_label;

    /**
     * Repeater fields
     *
     * @var array
     */
    public $sub_fields;

    /**
     * Override field construction method to add default button label but run parent constructor after that
     *
     * @param string $label Field label.
     * @param string $key   Field key.
     * @param string $name  Field name.
     */
    public function __construct( $label, $key = null, $name = null ) {
        $this->button_label = __( 'Add Row', 'acf' );

        parent::__construct( $label, $key, $name );
    }

    /**
     * Export field in ACF's native format.
     * This also exports sub fields
     *
     * @return array
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
     * Set maximum amount of layouts
     *
     * @param integer $max Maximum amount.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum amount of layouts
     *
     * @return integer Maximum amount
     */
    public function get_max() {
        return $this->max;
    }

    /**
     * Set minimum amount of layouts
     *
     * @param integer $min Minimum amount.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum amount of layouts
     *
     * @return integer Minimum amount
     */
    public function get_min() {
        return $this->min;
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
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Repeater: set_layout() does not accept argument "' . $layout . '"' );
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
     * Set add row button label
     *
     * @param string $button_label Text to show inside button.
     * @return self
     */
    public function set_button_label( string $button_label ) {
        $this->button_label = $button_label;

        return $this;
    }

    /**
     * Get button label
     *
     * @return string Button label
     */
    public function get_button_label() {
        return $this->button_label;
    }
}
