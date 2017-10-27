<?php
/**
 * Acf codifier range field
 */

namespace Geniem\ACF\Field;

/**
 * Class Number
 */
class Range extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'range';

    /**
     * Field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * String to show before field
     *
     * @var string
     */
    protected $prepend;

    /**
     * String to show after field
     *
     * @var string
     */
    protected $append = '';

    /**
     * Minimum value
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum value
     *
     * @var integer
     */
    protected $max;

    /**
     * Field step size
     *
     * @var integer
     */
    protected $step;

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
     * Set prepend text
     *
     * @param string $prepend String to prepend.
     * @return self
     */
    public function set_prepend( string $prepend ) {
        $this->prepend = $prepend;

        return $this;
    }

    /**
     * Get prepend value
     *
     * @return string
     */
    public function get_prepend() {
        return $this->prepend;
    }

    /**
     * Set append text
     *
     * @param string $append String to append.
     * @return self
     */
    public function set_append( string $append ) {
        $this->append = $append;

        return $this;
    }

    /**
     * Get append value
     *
     * @return string
     */
    public function get_append() {
        return $this->append;
    }

    /**
     * Set maximum value
     *
     * @param integer $max Maximum value.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum value
     *
     * @return integer Maximum value.
     */
    public function get_max() {
        return $this->max;
    }

    /**
     * Set minimum value
     *
     * @param integer $min Minimum value.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum value
     *
     * @return integer Minimum value.
     */
    public function get_min() {
        return $this->min;
    }

    /**
     * Set step size
     *
     * @param integer $step Step size.
     * @return self
     */
    public function set_step( int $step ) {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step size
     *
     * @return integer
     */
    public function get_step() {
        return $this->step;
    }
}
