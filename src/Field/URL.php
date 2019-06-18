<?php
/**
 * Acf codifier url field
 */

namespace Geniem\ACF\Field;

/**
 * Class URL
 */
class URL extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'url';

    /**
     * Field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * Whether the field is read only
     *
     * @var boolean
     */
    protected $readonly = false;

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
}
