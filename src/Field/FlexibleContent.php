<?php
/**
 * Acf codifier flexible content class
 */

namespace Geniem\ACF\Field;

/**
 * Class FlexibleContent
 */
class FlexibleContent extends \Geniem\ACF\Field {

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'flexible_content';

    /**
     * Button label
     *
     * @var string
     */
    protected $button_label;

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
     * Layouts added
     *
     * @var array
     */
    protected $layouts;

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
     * This also exports layout fields
     *
     * @param boolean $register Whether the field is to be registered.
     *
     * @return array
     */
    public function export( $register = false ) {
        $obj = parent::export( $register );

        if ( ! empty( $obj['layouts'] ) ) {
            $obj['layouts'] = array_map( function( $layout ) use ( $register ) {
                return $layout->export( $register );
            }, $obj['layouts'] );

            $obj['layouts'] = array_values( $obj['layouts'] );
        }

        return $obj;
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
     * Add a layout to the layouts
     *
     * @throws \Geniem\ACF\Exception Throws error if $layout is not valid.
     * @param \Geniem\ACF\Field\Flexible\Layout $layout Layout to add.
     * @return self
     */
    public function add_layout( \Geniem\ACF\Field\Flexible\Layout $layout ) {
        if ( ! ( $layout instanceof \Geniem\ACF\Field\Flexible\Layout ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\FlexibleContent: add_layout() requires an argument that is a string or type "\Geniem\ACF\Flexible\Layout"' );
        }

        $name = $layout->get_name();

        $this->layouts[ $name ] = $layout;

        $this->layouts = array_unique( $this->layouts );

        return $this;
    }

    /**
     * Remove layout from layouts
     *
     * @throws \Geniem\ACF\Exception Throws error if $layout is not valid.
     * @param  \Geniem\ACF\Field\Flexible\Layout|string $layout Either a layout class or layout name.
     * @return self
     */
    public function remove_layout( $layout ) {
        if ( ! ( $layout instanceof \Geniem\ACF\Field\Flexible\Layout || is_string( $layout ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\FlexibleContent: remove_layout() requires an argument that is a string or type "\Geniem\ACF\Flexible\Layout"' );
        }

        if ( is_string( $layout ) ) {
            $name = $layout;
        } else {
            $name = $layout->get_name();
        }

        unset( $this->layouts[ $name ] );

        return $this;
    }

    /**
     * Get layout by name
     *
     * @param  string $layout Layout name.
     * @return \Geniem\ACF\Field\Flexible\Layout
     */
    public function get_layout( string $layout ) {
        return $this->layouts[ $layout ];
    }

    /**
     * Get all layouts
     *
     * @return array
     */
    public function get_layouts() {
        return $this->layouts;
    }
}
