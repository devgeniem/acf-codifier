<?php
/**
 * Codifier Gutenberg Block class
 */

namespace Geniem\ACF;

use Geniem\ACF\Field\Common\Groupable;
use Geniem\ACF\Exception;
use Geniem\ACF\Group;
use Geniem\ACF\RuleGroup;
use Geniem\ACF\Interfaces\Renderer;

/**
 * Class Block
 */
class Block {

    /**
     * Import the groupable functionalities.
     */
    use Groupable;

    /**
     * Block slug or name, internal
     *
     * @var string
     */
    protected $name = '';

    /**
     * Block title, shows to the user
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
     * Block description, shows to the user
     *
     * @var string
     */
    protected $description = '';

    /**
     * Block fields.
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
     * The renderer for this block.
     *
     * @var Renderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param string $title Block title.
     * @param string $name  Block name.
     */
    public function __construct( string $title, string $name ) {
        $this->title = $title;
        $this->name  = $name;
    }

    /**
     * Setter for the name.
     *
     * @param string $name The name to set.
     * @return self
     */
    public function set_name( string $name ) : self {
        $this->name = $name;

        return $this;
    }

    /**
     * Getter for the name.
     *
     * @return string
     */
    public function get_name() : string {
        return $this->name;
    }

    /**
     * Setter for the title
     *
     * @param string $title The title to set.
     * @return self
     */
    public function set_title( string $title ) : self {
        $this->title = $title;

        return $this;
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
     * Setter for the category.
     *
     * @param string $category The category to set.
     * @return self
     */
    public function set_category( string $category ) : self {
        $this->category = $category;

        return $this;
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
     * Setter for the icon.
     *
     * @param string $icon The icon to set.
     * @return self
     */
    public function set_icon( string $icon ) : self {
        $this->icon = $icon;

        return $this;
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
     * Add a single keyword
     *
     * @param string $keyword The keyword to add.
     * @return self
     */
    public function add_keyword( string $keyword ) : self {
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Add multiple keywords
     *
     * @param array $keywords The keywords to add.
     * @return self
     */
    public function add_keywords( array $keywords ) : self {
        $this->keywords = array_merge( $this->keywords, $keywords );

        return $this;
    }

    /**
     * Remove a single keyword
     *
     * @param string $keyword The keyword to remove.
     * @return self
     */
    public function remove_keyword( string $keyword ) : self {
        $index = \array_search( $keyword, $this->keywords, true );

        unset( $this->keywords[ $index ] );

        return $this;
    }

    /**
     * Setter for the keywords.
     *
     * @param array $keywords The keywords to set.
     * @return self
     */
    public function set_keywords( array $keywords ) : self {
        $this->keywords = $keywords;

        return $this;
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
     * Setter for the description.
     *
     * @param string $description The description to set.
     * @return self
     */
    public function set_description( string $description ) : self {
        $this->description = $description;

        return $this;
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
     * Add a single post type
     *
     * @param string $post_type The post type to add.
     * @return self
     */
    public function add_post_type( string $post_type ) : self {
        $this->post_types[] = $post_type;

        return $this;
    }

    /**
     * Add multiple post types
     *
     * @param array $post_types The post types to add.
     * @return self
     */
    public function add_post_types( array $post_types ) : self {
        $this->post_types = array_merge( $this->post_types, $post_types );

        return $this;
    }

    /**
     * Remove a single post type
     *
     * @param string $post_type The post type to remove.
     * @return self
     */
    public function remove_post_type( string $post_type ) : self {
        $index = \array_search( $post_type, $this->post_types, true );

        unset( $this->post_types[ $index ] );

        return $this;
    }

    /**
     * Setter for the post_ ypes.
     *
     * @param array $post_types The post types to set.
     * @return self
     */
    public function set_post_types( array $post_types ) : self {
        $this->post_types = $post_types;

        return $this;
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
     * Setter for the display mode
     *
     * Options: auto, preview or edit.
     *
     * @param string $mode The display mode to set.
     * @return self
     */
    public function set_mode( string $mode ) : self {
        if ( ! in_array( $mode, [ 'auto', 'preview', 'edit' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Block: set_mode() does not accept argument "' . $mode . '"' );
        }

        $this->mode = $mode;

        return $this;
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
     * Setter for the default block alignment.
     *
     * @param string $align The alignment.
     * @return self
     */
    public function set_align( string $align ) : self {
        if ( ! in_array( $align, [ 'left', 'center', 'right', 'wide', 'full' ], true ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Block: set_mode() does not accept argument "' . $align . '"' );
        }

        $this->align = $align;

        return $this;
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
     * Setter for the supported features of the block.
     *
     * @param array $supports Array of supported features as strings.
     * @return self
     */
    public function set_supports( array $supports ) : self {
        $this->supports = $supports;

        return $this;
    }

    /**
     * Getter for the supported features of the block.
     *
     * @return array
     */
    public function get_supports() : array {
        return $this->supports;
    }

    /**
     * Add a data filtering function for the block
     *
     * @param callable $function The function to add.
     * @param int      $priority Priority for the filter.
     * @return self
     */
    public function add_data_filter( callable $function, int $priority = 10 ) : self {
        add_filter( 'codifier/blocks/data/' . $this->get_name(), $function, 2, $priority );

        return $this;
    }

    /**
     * Remove a data filtering function.
     *
     * @param callable $function The function to remove.
     * @param int      $priority Priority for the filter.
     * @return self
     */
    public function remove_data_filter( callable $function, int $priority = 10 ) : block {
        remove_filter( 'codifier/blocks/data/' . $this->get_name(), $function, $priority );

        return $this;
    }

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
     * Registers the ACF Gutenberg block
     *
     * @return array The registered block data.
     */
    public function register() : array {
        $this->register_field_group();

        return $this->register_block();
    }

    /**
     * Register the ACF field group for the block.
     *
     * @throws Exception ACF Codifier exception.
     */
    protected function register_field_group() {
        // Define a field group and set it to use the component fields.
        $field_group = new Group( $this->get_title(), $this->get_name() );

        $rule_group = new RuleGroup();
        $rule_group->add_rule( 'block', '==', 'acf/' . $this->get_name() );

        $field_group->add_rule_group( $rule_group );
        $field_group->add_fields( $this->get_fields() );
        $field_group->register();
    }

    /**
     * Register the ACF block.
     *
     * @return array
     */
    protected function register_block() {
        $args = [
            'name'            => $this->get_name(),
            'title'           => $this->get_title(),
            'description'     => $this->get_description(),
            'render_callback' => \Closure::fromCallable( [ __CLASS__, 'render' ] ),
            'category'        => $this->get_category(),
            'icon'            => $this->get_icon(),
            'keywords'        => $this->get_keywords(),
            'mode'            => $this->get_mode(),
            'align'           => $this->get_align(),
            'supports'        => $this->get_supports(),
        ];

        if ( ! empty( $this->get_post_types() ) ) {
            $args['post_types'] = $this->get_post_types();
        }

        // Register the ACF Block.
        return acf_register_block( $args );
    }

    /**
     * The render callback method for ACF blocks.
     * Passes the data to the defined renderer and
     * prints out the rendered markup.
     *
     * @param array $block The ACF block data.
     */
    protected function render( array $block = [] ) {
        $renderer = $this->get_renderer();
        $data     = \get_fields();

        $data = apply_filters( 'codifier/blocks/data/' . $this->get_name(), $data, $this );
        $data = apply_filters( 'codifier/blocks/data', $data, $this );

        echo $renderer->render(
            [
                'data'  => $data,
                'block' => $block,
            ]
        );
    }
}