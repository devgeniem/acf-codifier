<?php
/**
 * Codifier Component Interface
 */

namespace Geniem\ACF\Interfaces;

/**
 * Class Component
 *
 * @package Geniem\ACF
 */
interface Component {

    /**
     * Getter for the name.
     *
     * @return string
     */
    public function get_name() : string;

    /**
     * Getter for the title.
     *
     * @return string
     */
    public function get_title() : string;

    /**
     * Getter for the description.
     *
     * @return string
     */
    public function get_description() : string;

    /**
     * The implementation must contain a method
     * returning an array of fields defined for the component.
     *
     * @return array
     */
    public function get_fields() : array;

    /**
     * Getter for the component renderer.
     *
     * @return Renderer
     */
    public function get_renderer() : Renderer;

    /**
     * Getter for the category.
     *
     * @return string
     */
    public function get_category() : string;

    /**
     * Getter for the icon.
     *
     * @return string
     */
    public function get_icon() : string;

    /**
     * Getter for the keywords.
     *
     * @return array
     */
    public function get_keywords() : array;

}
