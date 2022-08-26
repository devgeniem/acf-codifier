<?php
/**
 * ACF Codifier repeater field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\MinMax;

/**
 * Class Repeater
 */
class Repeater extends \Geniem\ACF\Field\GroupableField {

    use MinMax;

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
     * Enable pagination
     *
     * @var integer
     */
    protected $pagination;

    /**
     * Rows per page
     *
     * @var integer
     */
    protected $rows_per_page;

    /**
     * Repeater fields
     *
     * @var array
     */
    public $sub_fields = [];

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
     * Set layout
     *
     * @throws \Geniem\ACF\Exception Throws error if layout is not valid.
     * @param string $layout New layout.
     * @return self
     */
    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ], true ) ) {
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
     * Enable pagination
     *
     * @return self
     */
    public function use_pagination() {
        $this->pagination = 1;

        return $this;
    }

    /**
     * Disable pagination
     *
     * @return self
     */
    public function no_pagination() {
        $this->pagination = 0;

        return $this;
    }

    /**
     * Get pagination
     *
     * @return integer
     */
    public function get_pagination() {
        return $this->pagination;
    }

    /**
     * Set rows per page
     *
     * @param integer $rows_per_page Rows per page.
     * @return self
     */
    public function set_rows_per_page( int $rows_per_page ) {
        $this->rows_per_page = $rows_per_page;

        return $this;
    }

    /**
     * Get rows per page
     *
     * @return integer
     */
    public function get_rows_per_page() {
        return $this->rows_per_page;
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
     * Set field whose value is shown when collapsed.
     *
     * @param \Geniem\ACF\Field $field The field to use.
     * @return self
     */
    public function set_collapsed( \Geniem\ACF\Field $field ) {
        $this->collapsed = $field->get_key();

        return $this;
    }

    /**
     * Remove collapsed field.
     *
     * @return self
     */
    public function remove_collapsed() {
        $this->collapsed = null;

        return $this;
    }
}
