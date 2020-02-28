<?php
/**
 * ACF Codifier append-prepend trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Append-Prepend trait
 */
trait AppendPrepend {
    /**
     * The field append value
     *
     * @var string
     */
    protected $append;

    /**
     * The field preend value
     *
     * @var string
     */
    protected $prepend;

    /**
     * Set field append value
     *
     * @param string $append The append value to set.
     *
     * @return self
     */
    public function set_append( string $append ) {
        $this->append = $append;

        return $this;
    }

    /**
     * Get the field append value
     *
     * @return string
     */
    public function get_append() {
        return $this->append;
    }

    /**
     * Set field prepend value
     *
     * @param string $prepend The prepend value to set.
     *
     * @return self
     */
    public function set_prepend( string $prepend ) {
        $this->prepend = $prepend;

        return $this;
    }

    /**
     * Get the field prepend value
     *
     * @return string
     */
    public function get_prepend() {
        return $this->prepend;
    }
}
