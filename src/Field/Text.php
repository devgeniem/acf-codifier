<?php
/**
 * Acf codifier text field
 */

namespace Geniem\ACF\Field;

/**
 * Class Text
 */
class Text extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'text';

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
    protected $append;

    /**
     * Max length for string
     *
     * @var integer
     */
    protected $maxlength;

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
