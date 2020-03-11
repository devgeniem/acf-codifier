<?php
/**
 * ACF Codifier readonly trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Readonly trait
 */
trait Readonly {
    /**
     * Whether the field is readonly or not.
     *
     * @var boolean
     */
    protected $readonly = false;

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
