<?php
/**
 * Custom button class for ACF Medium Editor
 */

namespace Geniem\ACF\Field\MediumEditor;

/**
 * Class Layout
 */
class CustomButton {
    /**
     * Button name
     *
     * @var string
     */
    protected $name;

    /**
     * Button label
     *
     * @var string
     */
    protected $label;

    /**
     * HTML tag to use
     *
     * @var string
     */
    protected $tag;

    /**
     * HTML attributes to use
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Export the button as an array
     *
     * @return array
     */
    public function export() {
        $obj = get_object_vars( $this );

        return $obj;
    }

    /**
     * Set name
     *
     * @param string $name New name.
     * @return self
     */
    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string Name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Set label
     *
     * @param string $label New label.
     * @return self
     */
    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string Label
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Set tag
     *
     * @param string $tag New tag.
     * @return self
     */
    public function set_tag( string $tag ) {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string Tag
     */
    public function get_tag() {
        return $this->tag;
    }

    /**
     * Set attributes to use
     *
     * Use a two-dimensional array with the inner level having two
     * keys: name and value.
     *
     * @throws \Geniem\ACF\Exception Exception if the type of the parameter is wrong.
     *
     * @param array $attributes An array of attributes.
     * @return self
     */
    public function set_attributes( $attributes ) {
        if ( ! is_array( $attributes ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\MediumEditor\CustomButton: set_attributes() requires an array as an argument' );
        }

        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add an attribute
     *
     * @param string $name Name of the attribute.
     * @param string $value Value of the attribute.
     * @return self
     */
    public function add_attribute( string $name, string $value ) {
        $this->attributes[ $name ] = [
            'name'  => $name,
            'value' => $value,
        ];

        return $this;
    }

    /**
     * Remove an attribute
     *
     * @param  string $name Attribute name.
     * @return self
     */
    public function remove_attribute( string $name ) {
        unset( $this->attributes[ $name ] );

        return $this;
    }

    /**
     * Get allowed attributes
     *
     * @return array
     */
    public function get_attributes() {
        return $this->attributes;
    }
}
