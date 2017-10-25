<?php
/**
 * Acf codifier textarea field
 */

namespace Geniem\ACF\Field;

/**
 * Class Textarea
 */
class Textarea extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'textarea';

    /**
     * Field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * Max length for string
     *
     * @var integer
     */
    protected $maxlength;

    /**
     * How new lines are treated
     *
     * @var string
     */
    protected $new_lines;

    /**
     * Max amount of rows
     *
     * @var integer
     */
    protected $rows;

    /**
     * Is field read only
     *
     * @var boolean
     */
    protected $readonly;

    /**
     * Is field disabled
     *
     * @var boolean
     */
    protected $disabled;

    /**
     * Set placeholder value
     *
     * @param string $placeholder Placeholder.
     * @return self
     */
    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get placeholder value
     *
     * @return string
     */
    public function get_placeholder() {
        return $this->placeholder;
    }

    /**
     * Set text max length
     *
     * @param integer $maxlength New max length.
     * @return self
     */
    public function set_maxlength( int $maxlength ) {
        $this->maxlength = $maxlength;

        return $this;
    }

    /**
     * Set new line handling
     *
     * @throws \Geniem\ACF\Exception Throws error if new_lines is not valid.
     * @param string $new_lines New line handling way.
     * @return self
     */
    public function set_new_lines( string $new_lines = 'wpautop' ) {
        if ( ! in_array( $new_lines, [ 'wpautop', 'br', '' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Textarea: set_new_lines() does not accept argument "' . $new_lines . '"' );
        }

        $this->new_lines = $new_lines;

        return $this;
    }

    /**
     * Get new line handling way
     *
     * @return string
     */
    public function get_new_lines() {
        return $this->new_lines;
    }

    /**
     * Set max rows
     *
     * @param integer $rows Max rows.
     * @return self
     */
    public function set_rows( int $rows ) {
        $this->rows = $rows;

        return $this;
    }

    /**
     * Get max rows
     *
     * @return integer
     */
    public function get_rows() {
        return $this->rows;
    }

    /**
     * Set field to read only
     *
     * @return self
     */
    public function set_readonly() {
        $this->readonly = true;

        return $this;
    }

    /**
     * Set field to writable
     *
     * @return self
     */
    public function set_writable() {
        $this->readonly = false;

        return $this;
    }

    /**
     * Get field readonly state
     *
     * @return boolean
     */
    public function get_readonly() {
        return $this->readonly;
    }

    /**
     * Disable field
     *
     * @return self
     */
    public function disable() {
        $this->disable = true;

        return $this;
    }

    /**
     * Enable field
     *
     * @return self
     */
    public function enable() {
        $this->disable = false;

        return $this;
    }

    /**
     * Get whether field is disabled or not
     *
     * @return boolean
     */
    public function get_disabled() {
        return $this->disabled;
    }
}
