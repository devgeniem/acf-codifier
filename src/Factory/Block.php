<?php
/**
 * ACF Gutenberg block component manager.
 */

namespace Geniem\ACF\Factory;

use Geniem\ACF\Exception;
use Geniem\ACF\Group;
use Geniem\ACF\Interfaces\ComponentFactory;
use Geniem\ACF\Interfaces\Component;
use Geniem\ACF\RuleGroup;

/**
 * Class Block
 *
 * ACF Gutenberg block component manager.
 *
 * @package Geniem\ACF
 */
class Block implements ComponentFactory {

    /**
     * Component dependency.
     *
     * @var Component
     */
    protected $component;

    /**
     * Block constructor.
     *
     * @param Component $component The component dependency.
     *
     * @throws Exception ACF Codifier exception.
     */
    public function __construct( Component $component ) {
        $this->component = $component;

        if ( ! function_exists( 'acf_register_block' ) ) {
            throw new Exception( 'Advanced Custom Fields must be activated!' );
        }
    }

    /**
     * Registers the ACF Gutenberg block with the component data.
     *
     * @return array The registered block data.
     *
     * @throws Exception ACF Codifier exception.
     */
    public function create() {
        $this->register_field_group();
        $block = $this->register_block();
        return $block;
    }

    /**
     * Register the ACF field group for the block.
     *
     * @throws Exception ACF Codifier exception.
     */
    protected function register_field_group() {

        // Define a field group and set it to use the component fields.
        $field_group = new Group( $this->component->get_title(), $this->component->get_name() );

        $rule_group = new RuleGroup();
        $rule_group->add_rule( 'block', '==', 'acf/' . $this->component->get_name() );

        $field_group->add_rule_group( $rule_group );

        $field_group->add_fields( $this->component->get_fields() );

        $field_group->register();
    }

    /**
     * Register the ACF block.
     *
     * @return array
     */
    protected function register_block() {
        // Register the ACF Block.
        $block = acf_register_block(
            [
                'name'            => $this->component->get_name(),
                'title'           => $this->component->get_title(),
                'description'     => $this->component->get_description(),
                'render_callback' => [ $this, 'render' ],
                'category'        => $this->component->get_category(),
                'icon'            => $this->component->get_icon(),
                'keywords'        => $this->component->get_keywords(),
            ]
        );

        return $block;
    }

    /**
     * The render callback method for ACF blocks.
     * Passes the data to the defined renderer and
     * prints out the rendered markup.
     *
     * @param array $block The ACF block data.
     */
    public function render( array $block = [] ) {
        $renderer = $this->component->get_renderer();

        $data = get_fields();

        echo $renderer->render(
            [
                'data'  => $data,
                'block' => $block,
            ]
        );
    }

}
