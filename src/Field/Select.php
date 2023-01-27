<?php
/**
 * Acf codifier select field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\Placeholder;

/**
 * Class Select
 */
class Select extends \Geniem\ACF\Field {

    use Disabled, Placeholder;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'select';

    /**
     * Field choices
     *
     * @var array
     */
    protected $choices;

    /**
     * Whether an empty value should be allowed
     *
     * @var integer
     */
    protected $allow_null;

    /**
     * Can multiple be chosen
     *
     * @var integer
     */
    protected $multiple;

    /**
     * Whether the new ui should be used
     *
     * @var integer
     */
    protected $ui;

    /**
     * Whether ajax should be used for loading the choices
     *
     * @var integer
     */
    protected $ajax;

    /**
     * Format when returned via get_field
     *
     * @var string
     */
    protected $return_format = 'value';

    /**
     * Set choices for the checkbox
     *
     * @throws \Geniem\ACF\Exception If the parameter or its end result are not arrays.
     * @param mixed $choices Choices as key-value pair strings or a callable that returns one.
     * @return self
     */
    public function set_choices( $choices ) {
        if ( is_callable( $choices ) ) {
            $result = call_user_func( $choices );
        }
        else {
            $result = $choices;
        }

        // If the value is not an array.
        if ( ! is_array( $result ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Select: set_choices() requires an array or a callable that returns an array.' );
        }

        $this->choices = $result;

        return $this;
    }

    /**
     * Adds a choice to the choices array
     *
     * @throws \Geniem\ACF\Exception Info about incorrect array size.
     * @param  mixed $choice Array or string to add.
     * @param  mixed $value  Value to add if $choice is not array, if not set uses $choice.
     * @return self
     */
    public function add_choice( $choice, $value = null ) {
        if ( is_array( $choice ) ) {
            if ( count( $choice ) !== 1 ) {
                throw new \Geniem\ACF\Exception( 'Geniem\ACF\Select: add_choice() requires an array with exactly one value as an argument' );
            }

            $this->choices = array_merge( $this->choices, $choice );
        }
        else {
            if ( ! isset( $value ) ) {
                $value = $choice;
            }

            $this->choices[ $value ] = $choice;
        }

        return $this;
    }

    /**
     * Remove a choice.
     *
     * @throws \Geniem\ACF\Exception Info about incorrect array size.
     * @param mixed $choice Choice to be removed.
     * @return self
     */
    public function remove_choice( $choice ) {
        if ( is_array( $choice ) ) {
            if ( count( $choice ) !== 1 ) {
                throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: remove_choice() requires an array with exactly one value as an argument' );
            }

            if ( isset( $this->choices[ $choice[0] ] ) && $this->choices[ $choice[0] ] === $choice[1] ) {
                unset( $this->choices[ $choice[0] ] );
            }
        } else {
            $position = array_search( $choice, $this->choices, true );

            if ( ( $position !== false ) ) {
                unset( $this->choices[ $position ] );
            }
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

    /**
     * Allow multiple values
     *
     * @return self
     */
    public function allow_multiple() {
        $this->multiple = 1;

        return $this;
    }

    /**
     * Disallow multiple values
     *
     * @return self
     */
    public function disallow_multiple() {
        $this->multiple = 0;

        return $this;
    }

    /**
     * Get allow multiple status
     *
     * @return integer
     */
    public function get_allow_multiple() {
        return $this->multiple;
    }

    /**
     * Enable custom ui
     *
     * @return self
     */
    public function use_ui() {
        $this->ui = 1;

        return $this;
    }

    /**
     * Disable custom ui
     *
     * @return self
     */
    public function no_ui() {
        $this->ui = 0;

        return $this;
    }

    /**
     * Get custom ui state
     *
     * @return integer
     */
    public function ui() {
        return $this->ui;
    }

    /**
     * Enable loading values via ajax
     *
     * @return self
     */
    public function use_ajax() {
        $this->ajax = 1;

        return $this;
    }

    /**
     * Disable loading values via ajax
     *
     * @return self
     */
    public function no_ajax() {
        $this->ajax = 0;

        return $this;
    }

    /**
     * Get ajax loading state
     *
     * @return integer
     */
    public function get_ajax() {
        return $this->ajax;
    }

    /**
     * Set return format
     *
     * @throws \Geniem\ACF\Exception Throws error if $return_format is not valid.
     * @param string $return_format Return format to use.
     * @return self
     */
    public function set_return_format( string $return_format = 'value' ) {
        if ( ! in_array( $return_format, [ 'value', 'label', 'array' ], true ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Select: set_return_format() does not accept argument "' . $return_format . '"' );
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
}
