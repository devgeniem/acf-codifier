<?php
/**
 * Acf codifier oembed field
 */

namespace Geniem\ACF\Field;

/**
 * Class Oembed
 */
class Oembed extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'oembed';

    /**
     * Embed width
     *
     * @var string
     */
    protected $width;

    /**
     * Embed height
     *
     * @var string
     */
    protected $height;

    /**
     * Set embed width
     *
     * @param string $width New width.
     * @return self
     */
    public function set_width( string $width ) {
        $this->width = $width;

        return $this;
    }

    /**
     * Get embed width
     *
     * @return string
     */
    public function get_width() {
        return $this->width;
    }

    /**
     * Set embed height
     *
     * @param string $height New height.
     * @return self
     */
    public function set_height( string $height ) {
        $this->height = $height;

        return $this;
    }

    /**
     * Get embed height
     *
     * @return string
     */
    public function get_height() {
        return $this->height;
    }
}
