<?php
/**
 * ACF Codifier Checkbox field
 */

namespace Geniem\ACF\Field;

/**
 * Class Checkbox
 */
class Checkbox extends \Geniem\ACF\Field {
    /**
     * The field type
     *
     * @var string Checkbox
     */
    protected $type = 'checkbox';

    /**
     * The choices for the field
     *
     * @var array
     */
    protected $choices;

    /**
     * The checkbox layout, vertical or horizontal
     *
     * @var string
     */
    protected $layout;

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
        $position = array_search( $choice, $this->choices );

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
     * Set whether the checkboxes are displayed vertically or horizontally.
     *
     * @param  string $layout        Display style.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_layout( string $layout = 'vertical' ) {
        if ( ! in_array( $layout, [ 'vertical', 'horizontal' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_layout() does not accept argument "' . $layout . '"' );
        }

        $this->layout = $layout;

        return $this;
    }

    /**
     * Get the current display style of the checkbox.
     *
     * @return string
     */
    public function get_layout() {
        return $this->layout;
    }
}
