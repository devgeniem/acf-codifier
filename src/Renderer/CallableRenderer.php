<?php
/**
 * The callable renderer for Codifier components.
 */

namespace Geniem\ACF\Renderer;

use Geniem\ACF\Interfaces\Renderer;

/**
 * Class Callable renderer
 *
 * Block renderer with simple methods.
 *
 * @package Geniem\ACF
 */
class CallableRenderer implements Renderer {

    /**
     * Method
     *
     * @var callable
     */
    protected $method;

    /**
     * Constructor
     *
     * @param callable $method The method to render the block with.
     *
     * @throws \Exception If template is not found.
     */
    public function __construct( callable $method ) {
        $this->method = $method;
    }

    /**
     * Renders ACF fields with the given method.
     *
     * @param array $fields ACF field values.
     *
     * @return string
     */
    public function render( array $fields ) : string {
        return \call_user_func( $this->method, $fields['data'] );
    }
}
