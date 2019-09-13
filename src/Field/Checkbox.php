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
    protected $layout = 'vertical';

    /**
     * Should a toggle all checkbox be shown
     *
     * @var integer
     */
    protected $toggle;

    /**
     * Can user add custom values
     *
     * @var integer
     */
    protected $allow_custom;

    /**
     * Should custom values be saved to default possibilities
     *
     * @var integer
     */
    protected $save_custom;

    /**
     * Array of disabled checkboxes
     *
     * @var array
     */
    protected $disabled;

    /**
     * Whether to disable all checkboxes or not
     *
     * @var boolean
     */
    protected $disable_all = false;

    /**
     * Export field in ACF's native format.
     *
     * @param boolean $register Whether the field is to be registered.
     *
     * @return array
     */
    public function export( $register = false ) {
        if ( $register ) {
            if ( $this->disable_all ) {
                $this->disabled = array_keys( $this->choices );
            }

            unset( $this->disable_all );
        }

        // Call the original export method
        $obj = parent::export( $register );

        return $obj;
    }

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

    /**
     * Allow toggle all checkbox
     *
     * @return self
     */
    public function allow_toggle() {
        $this->toggle = 1;

        return $this;
    }

    /**
     * Disallow toggle all checkbox
     *
     * @return self
     */
    public function disallow_toggle() {
        $this->toggle = 0;

        return $this;
    }

    /**
     * Get toggle all checkbox
     *
     * @return integer
     */
    public function get_toggle() {
        return $this->toggle;
    }

    /**
     * Allow custom values
     *
     * @return self
     */
    public function allow_custom() {
        $this->allow_custom = 1;

        return $this;
    }

    /**
     * Disallow custom values
     *
     * @return self
     */
    public function disallow_custom() {
        $this->allow_custom = 0;

        return $this;
    }

    /**
     * Get allow custom values status
     *
     * @return integer
     */
    public function get_custom() {
        return $this->allow_custom;
    }

    /**
     * Allow saving custom values to default values
     *
     * @return self
     */
    public function allow_save_custom() {
        $this->save_custom = 1;

        return $this;
    }

    /**
     * Disallow saving custom values to default values
     *
     * @return self
     */
    public function disallow_save_custom() {
        $this->save_custom = 0;

        return $this;
    }

    /**
     * Get save custom status
     *
     * @return integer
     */
    public function get_save_custom() {
        return $this->save_custom;
    }

    /**
     * Disable all checkboxes
     *
     * @return self
     */
    public function disable() {
        $this->disable_all = true;

        return $this;
    }

    /**
     * Set all checkboxes to be enabled
     *
     * @return self
     */
    public function enable() {
        $this->disable_all = false;
        $this->disabled = [];

        return $this;
    }

    /**
     * Set the disabled checkboxes as array
     *
     * @param array $keys The checkboxes to disable.
     * @return self
     */
    public function set_disabled( array $keys ) {
        $this->disabled = array_keys( $keys );

        return $this;
    }

    /**
     * Get the disabled checkboxes
     *
     * @return string|array
     */
    public function get_disabled() {
        if ( $this->disable_all ) {
            return 'all';
        }
        else {
            return $this->disabled;
        }
    }
}
