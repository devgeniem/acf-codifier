<?php
/**
 * ACF Codifier Image trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Image Trait
 */
trait Image {

    use File;

    /**
     * Minimum width
     *
     * @var integer
     */
    protected $min_width;

    /**
     * Minimum height
     *
     * @var integer
     */
    protected $min_height;

    /**
     * Max width
     *
     * @var integer
     */
    protected $max_width;

    /**
     * Max height
     *
     * @var integer
     */
    protected $max_height;

    /**
     * Set minimum width
     *
     * @param integer $min_width Minimum width.
     * @return self
     */
    public function set_min_width( int $min_width ) {
        $this->min_width = $min_width;

        return $this;
    }

    /**
     * Get minimum width
     *
     * @return integer Minimum width
     */
    public function get_min_width() {
        return $this->min_width;
    }

    /**
     * Set minimum height
     *
     * @param integer $min_height Minimum height.
     * @return self
     */
    public function set_min_height( int $min_height ) {
        $this->min_height = $min_height;

        return $this;
    }

    /**
     * Get minimum height
     *
     * @return integer Minimum height
     */
    public function get_min_height() {
        return $this->min_height;
    }

    /**
     * Set maximum width
     *
     * @param integer $max_width Maximum width.
     * @return self
     */
    public function set_max_width( int $max_width ) {
        $this->max_width = $max_width;

        return $this;
    }

    /**
     * Get maximum width
     *
     * @return integer Maximum width
     */
    public function get_max_width() {
        return $this->max_width;
    }

    /**
     * Set maximum height
     *
     * @param integer $max_height Maximum height.
     * @return self
     */
    public function set_max_height( int $max_height ) {
        $this->max_height = $max_height;

        return $this;
    }

    /**
     * Get maximum height
     *
     * @return integer Maximum height
     */
    public function get_max_height() {
        return $this->max_height;
    }
}