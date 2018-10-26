<?php
/**
 * Created by PhpStorm.
 * User: teris
 * Date: 26.10.2018
 * Time: 13.20
 */

namespace Geniem\ACF\Interfaces;

use Geniem\ACF\Field;

interface Renderer {

    /**
     * A rendered must implement the render method.
     *
     * @param array $data An array of ACF field values.
     * @return string
     */
    public function render( array $data ) : string;

}
