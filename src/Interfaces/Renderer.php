<?php
/**
 * Interface Renderer
 */

namespace Geniem\ACF\Interfaces;

/**
 * Interface Renderer
 *
 * @package Geniem\ACF
 */
interface Renderer {

    /**
     * A rendered must implement the render method.
     *
     * @param array $data An array of ACF field values.
     * @return string
     */
    public function render( array $data ) : string;

}
