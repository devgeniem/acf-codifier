<?php
/**
 * ACF Codifier disabled trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Disabled trait
 */
trait Disabled {
    /**
     * Whether the field is disabled or not.
     *
     * @var boolean
     */
    protected $disabled = false;

    /**
     * Set field disabled
     *
     * @return self
     */
    public function disable() {
        $this->disabled = true;

        return $this;
    }

    /**
     * Set field enabled
     *
     * @return self
     */
    public function enable() {
        $this->disabled = false;

        return $this;
    }

    /**
     * Get field's disabled state
     *
     * @return boolean
     */
    public function get_disabled() {
        return $this->disabled;
    }
}
