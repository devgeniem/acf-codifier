<?php
/**
 * Codifier Component abstraction.
 */

namespace Geniem\ACF;

use Geniem\ACF\Field\Common\Groupable,
    Geniem\ACF\Interfaces\Component as ComponentInterface;
use Geniem\ACF\Interfaces\Renderer;

/**
 * Class Component
 *
 * This class is an abstraction of a ACF Codifier component.
 * A component is a reusable set of fields.
 *
 * @package Geniem\ACF
 */
abstract class Component implements ComponentInterface {

    /**
     * Import the groupable functionalities.
     */
    use Groupable;

    /**
     * Component slug or name, internal
     *
     * @var string
     */
    protected $name = '';

    /**
     * Component title, shows to the user
     *
     * @var string
     */
    protected $title = '';

    /**
     * Getter for the category.
     *
     * @var string
     */
    protected $category = '';

    /**
     * Getter for the icon.
     *
     * @var string
     */
    protected $icon = '';

    /**
     * Getter for the keywords.
     *
     * @var array
     */
    protected $keywords = [];


    /**
     * Component description, shows to the user
     *
     * @var string
     */
    protected $description = '';

    /**
     * Component fields.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * The renderer for this component.
     *
     * @var Renderer
     */
    protected $renderer;

    /**
     * Getter for the name.
     *
     * @return string
     */
    public function get_name() : string {

        return $this->name;
    }

    /**
     * Getter for the title.
     *
     * @return string
     */
    public function get_title() : string {

        return $this->title;
    }

    /**
     * Getter for the description.
     *
     * @return string
     */
    public function get_description() : string {

        return $this->description;
    }

    /**
     * Constructor method
     *
     * @param array $args Arguments to give to the block on creation.
     */
    public function __construct( array $args ) {}

    /**
     * Set the renderer for the component.
     *
     * @param Renderer $renderer The renderer.
     */
    public function set_renderer( Renderer $renderer ) {
        $this->renderer = $renderer;
    }

    /**
     * Getter for the component renderer.
     *
     * @return Renderer
     * @throws Exception An exception is thrown if the renderer is not set
     *                   and this method is called.
     */
    public function get_renderer(): Renderer {

        if ( empty( $this->renderer ) ) {
            // The extending class must implement this method
            // if the renderer is not set.
            throw new Exception( 'You must implement get_renderer()' );
        }
        return $this->renderer;
    }

    /**
     * Getter for the category.
     *
     * @return string
     */
    public function get_category() : string {
        return $this->category;
    }

    /**
     * Getter for the icon.
     *
     * @return string
     */
    public function get_icon() : string {
        return $this->icon;
    }

    /**
     * Getter for the keywords.
     *
     * @return array
     */
    public function get_keywords() : array {
        return $this->keywords;
    }
}
