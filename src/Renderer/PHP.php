<?php
/**
 * The PHP renderer for Codifier components.
 */

namespace Geniem\ACF\Renderer;

use Geniem\ACF\Interfaces\Renderer;

/**
 * Class PHPComponentRenderer
 *
 * Component renderer for PHP files.
 *
 * @package Geniem\ACF
 */
class PHP implements Renderer {

    /**
     * Renders ACF fields with the given template file.
     *
     * @param string $template The template file path.
     * @param array  $fields   ACF field values.
     */
    public function render( string $template, array $fields ) : void {
        extract( $fields );

		if ( file_exists( $template ) ) {
            include $template;
        }

    }

}