<?php
/**
 * Acf Codifier Medium Editor field
 */

namespace Geniem\ACF\Field;

/**
 * Class MediumEditor
 */
class MediumEditor extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'medium_editor';

    /**
     * Field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * Standard buttons to show
     *
     * @var array
     */
    protected $standard_buttons = [];

    /**
     * Custom buttons
     *
     * @var array
     */
    protected $custom_buttons = [];

    /**
     * Other Medium Editor options
     *
     * @var array
     */
    protected $other_options = [];

    /**
     * Delay status
     *
     * @var integer
     */
    protected $delay = 0;

    public function export( $register = false ) {
        $obj = parent::export( $register );

        $obj['custom_buttons'] = array_map( function( $cb ) use ( $register ) {
            return $cb->export( $register );
        }, $obj['custom_buttons'] );

        return $obj;
    }

    /**
     * Set placeholder value
     *
     * @param string $placeholder Placeholder.
     * @return self
     */
    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get placeholder value
     *
     * @return string
     */
    public function get_placeholder() {
        return $this->placeholder;
    }

    /**
     * Set buttons to show
     *
     * Possible values:
     * - bold
     * - italic
     * - underline
     * - strikethrough
     * - subscript
     * - superscript
     * - anchor
     * - image
     * - quote
     * - pre
     * - orderedlist
     * - unorderedlist
     * - indent
     * - outdent
     * - justifyLeft
     * - justifyCenter
     * - justifyRight
     * - justifyFull
     * - h1
     * - h2
     * - h3
     * - h4
     * - h5
     * - h6
     * - html
     * - removeFormat
     *
     * @throws \Geniem\ACF\Exception Throws error if $buttons is not valid.
     * @param array $buttons An array of buttons.
     * @return self
     */
    public function set_buttons( $buttons ) {
        if ( ! is_array( $buttons ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_buttons() requires an array as an argument' );
        }

        $this->standard_buttons = $buttons;

        return $this;
    }

    /**
     * Add a standard button
     *
     * Possible values:
     * - bold
     * - italic
     * - underline
     * - strikethrough
     * - subscript
     * - superscript
     * - anchor
     * - image
     * - quote
     * - pre
     * - orderedlist
     * - unorderedlist
     * - indent
     * - outdent
     * - justifyLeft
     * - justifyCenter
     * - justifyRight
     * - justifyFull
     * - h1
     * - h2
     * - h3
     * - h4
     * - h5
     * - h6
     * - html
     * - removeFormat
     *
     * @param string $button Button.
     * @return self
     */
    public function add_button( $button ) {
        $this->standard_buttons[] = $button;

        $this->standard_buttons = array_unique( $this->standard_buttons );

        return $this;
    }

    /**
     * Remove a standard button
     *
     * @param  string $button Button.
     * @return self
     */
    public function remove_button( $button ) {
        $position = array_search( $button, $this->standard_buttons, true );

        if ( ( $position !== false ) ) {
            unset( $this->standard_buttons[ $position ] );
        }

        return $this;
    }

    /**
     * Get set standard buttons
     *
     * @return array
     */
    public function get_buttons() {
        return $this->standard_buttons;
    }

    /**
     * Add a button to the custom buttons
     *
     * @throws \Geniem\ACF\Exception Throws error if $custom_button is not valid.
     * @param \Geniem\ACF\Field\MediumEditor\CustomButton $custom_button CustomButton to add.
     * @return self
     */
    public function add_custom_button( \Geniem\ACF\Field\MediumEditor\CustomButton $custom_button ) {
        if ( ! ( $custom_button instanceof \Geniem\ACF\Field\MediumEditor\CustomButton ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\MediumEditor: add_custom_button() requires an argument that is of type "\Geniem\ACF\MediumEditor\CustomButton"' );
        }

        $name = $custom_button->get_name();

        $this->custom_buttons[ $name ] = $custom_button;

        $this->custom_buttons = array_unique( $this->custom_buttons );

        return $this;
    }

    /**
     * Remove a button from custom buttons
     *
     * @throws \Geniem\ACF\Exception Throws error if $custom_button is not valid.
     * @param  \Geniem\ACF\Field\MediumEditor\CustomButton|string $custom_button Either a custom button class or customButton name.
     * @return self
     */
    public function remove_custom_button( $custom_button ) {
        if ( ! ( $custom_button instanceof \Geniem\ACF\Field\MediumEditor\CustomButton || is_string( $custom_button ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\MediumEditor: remove_custom_button() requires an argument that is a string or type "\Geniem\ACF\MediumEditor\CustomButton"' );
        }

        if ( is_string( $custom_button ) ) {
            $name = $custom_button;
        }
        else {
            $name = $custom_button->get_name();
        }

        unset( $this->custom_buttons[ $name ] );

        return $this;
    }

    /**
     * Get custom button by name
     *
     * @param  string $custom_button CustomButton name.
     * @return \Geniem\ACF\Field\MediumEditor\CustomButton
     */
    public function get_custom_button( string $custom_button ) {
        return $this->custom_buttons[ $custom_button ];
    }

    /**
     * Get all custom buttons
     *
     * @return array
     */
    public function get_custom_buttons() {
        return $this->custom_buttons;
    }

    /**
     * Set Medium Editor options
     *
     * @throws \Geniem\ACF\Exception Throws error if $options is not valid.
     * @param array $options An array of options to set.
     * @return self
     */
    public function set_options( $options ) {
        if ( ! is_array( $options ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_options() requires an array as an argument' );
        }

        $this->other_options = $options;

        return $this;
    }

    /**
     * Add an option
     *
     * @param string $option An option to add.
     * @return self
     */
    public function add_option( $option ) {
        $this->other_options[] = $option;

        $this->other_options = array_unique( $this->other_options );

        return $this;
    }

    /**
     * Remove an option
     *
     * @param  string $option An option to remove.
     * @return self
     */
    public function remove_option( $option ) {
        $position = array_search( $option, $this->other_options, true );

        if ( ( $position !== false ) ) {
            unset( $this->other_options[ $position ] );
        }

        return $this;
    }

    /**
     * Get set options
     *
     * @return array
     */
    public function get_options() {
        return $this->other_options;
    }

    /**
     * Get other choice values status
     *
     * @return integer
     */
    public function get_other_choice() {
        return $this->other_choice;
    }

    /**
     * Delay loading until the field is clicked
     *
     * @return self
     */
    public function delay_loading() {
        $this->delay = 1;

        return $this;
    }

    /**
     * Do not delay loading until the field is clicked
     *
     * @return self
     */
    public function dont_delay_loading() {
        $this->delay = 0;

        return $this;
    }

    /**
     * Get delay status
     *
     * @return integer
     */
    public function get_delay_status() {
        return $this->delay;
    }
}
