<?php
/**
 * ACF Codifier Extended Wysiwyg field
 */

namespace Geniem\ACF\Field;

/**
 * Class ExtendedWysiwyg
 */
class ExtendedWysiwyg extends Wysiwyg {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'extended_wysiwyg';

    /**
     * The height of the element
     *
     * @var integer
     */
    protected $height = 300;

    /**
     * Set the height of the element
     *
     * @param integer $height The height.
     * @return self
     */
    public function set_height( int $height ) {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the height of the element.
     *
     * @return integer
     */
    public function get_height() : int {
        return $this->height;
    }
}