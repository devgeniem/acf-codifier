<?php
/**
 * Acf codifier gallery class
 */

namespace Geniem\ACF\Field;

/**
 * Class Gallery
 */
class Gallery extends Image {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'gallery';

    /**
     * Minimum amount of images to show
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum amount of images to show
     *
     * @var integer
     */
    protected $max;

    /**
     * Set minimum amount
     *
     * @param integer $min Minimum amount.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum amount
     *
     * @return integer Minimum amount
     */
    public function get_min() {
        return $this->min;
    }

    /**
     * Set maximum amount
     *
     * @param integer $max Maximum amount.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum amount
     *
     * @return integer Maximum amount
     */
    public function get_max() {
        return $this->max;
    }
}
