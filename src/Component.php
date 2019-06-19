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
     * The block category
     *
     * @var string
     */
    protected $category = '';

    /**
     * The block icon. Can hold both the string or array representation.
     *
     * @var string|array
     */
    protected $icon = '';

    /**
     * The block keywords.
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
     * Array of post types to restrict this block type to.
     *
     * @var array
     */
    protected $post_types = [];

    /**
     * Display mode for the block.
     *
     * Options: auto, preview or edit.
     *
     * @var string
     */
    protected $mode = 'preview';

    /**
     * The default block alignment.
     *
     * Options: left, center, right, wide or full.
     *
     * @var string
     */
    protected $align = '';

    /**
     * An array of features for the block to support.
     *
     * @see https://wordpress.org/gutenberg/handbook/block-api/
     *
     * @var array
     */
    protected $supports = [];

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
     * @param array|null $args Arguments to give to the block on creation.
     */
    public function __construct( ?array $args = null ) {}

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
     * @return string|array
     */
    public function get_icon() {
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

    /**
     * Getter for the post types.
     *
     * @return array
     */
    public function get_post_types() : array {
        return $this->post_types;
    }

    /**
     * Getter for the display mode.
     *
     * @return string
     */
    public function get_mode() : string {
        return $this->mode;
    }

    /**
     * Getter for the default block alignment.
     *
     * @return string
     */
    public function get_align() : string {
        return $this->align;
    }

    /**
     * Getter for the supported features of the block.
     *
     * @return array
     */
    public function get_supports() : array {
        return $this->supports;
    }
}
