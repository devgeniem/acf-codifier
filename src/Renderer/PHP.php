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
     * Template file path.
     *
     * @var string
     */
    protected $template;

    /**
     * Constructor
     *
     * @param string $template Path to template file.
     *
     * @throws \Exception If template is not found.
     */
    public function __construct( string $template ) {
        if ( file_exists( $template ) ) {
            $this->template = $template;
        }
        else {
            throw new \Exception( 'Template file ' . $template . ' can not be found.' );
        }
    }

    /**
     * Renders ACF fields with the given template file.
     *
     * @param array $fields ACF field values.
     *
     * @return string
     */
    public function render( array $fields ) : string {
        extract( $fields['data'] ); // phpcs:ignore

        ob_start();
        include $this->template;
        return ob_get_clean();

    }

}
