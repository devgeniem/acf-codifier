<?php
/**
 * ACF Codifier Button group field
 */

namespace Geniem\ACF\Field;

/**
 * Class ButtonGroup
 */
class ButtonGroup extends Checkbox {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'button_group';

    /**
     * Choices
     *
     * @var array
     */
    protected $choices = [];

    /**
     * The layout style of the field.
     *
     * @var string
     */
    protected $layout = 'vertical';

    /**
     * Return format to set
     *
     * @var string
     */
    protected $return_format;

    /**
     * Can this field be left empty
     *
     * @var integer
     */
    protected $allow_null;

    /**
     * Set choices for the checkbox
     *
     * @param array $choices Choices as strings.
     * @return self
     */
    public function set_choices( array $choices ) {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Add a choice.
     *
     * @param string $choice Choice to be added.
     * @param mixed  $value Value to save if choice selected, uses $choice if not set.
     * @return self
     */
    public function add_choice( string $choice, $value ) {
        if ( ! isset( $value ) ) {
            $value = $choice;
        }

        $this->choices[ $value ] = $choice;

        return $this;
    }

    /**
     * Remove a choice.
     *
     * @param string $choice Choice to be removed.
     * @return self
     */
    public function remove_choice( string $choice ) {
        $position = array_search( $choice, $this->choices, true );

        if ( ( $position !== false ) ) {
            unset( $this->choices[ $position ] );
        }

        return $this;
    }

    /**
     * Get all choices.
     *
     * @return array
     */
    public function get_choices() {
        return $this->choices;
    }

    /**
     * Set layout
     *
     * @throws \Geniem\ACF\Exception Throws error if layout is not valid.
     * @param string $layout Layout.
     * @return self
     */
    public function set_layout( string $layout = 'vertical' ) {
        if ( ! in_array( $layout, [ 'vertical', 'horizontal' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\ButtonGroup: set_layout() does not accept argument "' . $layout . '"' );
        }

        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return string
     */
    public function get_layout() {
        return $this->layout;
    }

    /**
     * Set return format
     *
     * @throws \Geniem\ACF\Exception Throws error if $return_format is not valid.
     * @param string $return_format Return format to use.
     * @return self
     */
    public function set_return_format( string $return_format = 'value' ) {
        if ( ! in_array( $return_format, [ 'value', 'label', 'array' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\PostObject: set_return_format() does not accept argument "' . $return_format . '"' );
        }

        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Get return format
     *
     * @return string
     */
    public function get_return_format() {
        return $this->return_format;
    }

    /**
     * Allow null value
     *
     * @return self
     */
    public function allow_null() {
        $this->allow_null = 1;

        return $this;
    }

    /**
     * Disallow null value
     *
     * @return self
     */
    public function disallow_null() {
        $this->allow_null = 0;

        return $this;
    }

    /**
     * Get allow null status
     *
     * @return integer
     */
    public function get_allow_null() {
        return $this->allow_null;
    }
}
