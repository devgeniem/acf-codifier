<?php
/**
 * ACF Codifier placeholder trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Placeholder trait
 */
trait Placeholder {
    /**
     * The field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * Set field placeholder
     *
     * @param string $placeholder The placeholder to set.
     *
     * @return self
     */
    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get field placeholder
     *
     * @return string
     */
    public function get_placeholder() {
        return $this->placeholder;
    }
}
