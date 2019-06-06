<?php
/**
 * The Dust renderer for Codifier components.
 */

namespace Geniem\ACF\Renderer;

use Geniem\ACF\Interfaces\Renderer;

/**
 * Class DustComponentRenderer
 *
 * Component renderer for Dust template files.
 *
 * @package Geniem\ACF
 */
class Dust implements Renderer {

    /**
     * Template file path.
     *
     * @var string
     */
    protected $template;

    /**
     * DustPHP instance
     *
     * @var \Dust\Dust
     */
    protected static $dust;

    /**
     * Constructor
     *
     * @param string $template Path to template file.
     *
     * @throws \Exception If template is not found.
     */
    public function __construct( string $template ) {
        // Ensure we have DustPHP
        if ( class_exists( '\\Dust\\Dust' ) ) {
            // Allow using external DustPHP instance.
            $dust = apply_filters( 'codifier/components/dustphp', null ); // phpcs:ignore

            if ( empty( $dust ) ) {
                self::$dust = new \Dust\Dust();
            }
            else {
                self::$dust = $dust;
            }
        }
        else {
            throw new \Exception( 'DustPHP is not present.' );
        }

        // Ensure that the template file exists
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
        $compiled = self::$dust->compileFile( $this->template );

        return self::$dust->renderTemplate( $compiled, $fields['data'] );
    }
}
