<?php
/**
 * Acf codifier truefalse field
 */

namespace Geniem\ACF\Field;

/**
 * Class TrueFalse
 */
class TrueFalse extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'true_false';

    /**
     * Message to show alongside button
     *
     * @var string
     */
    protected $message;

    /**
     * Should custom ui be used
     *
     * @var integer
     */
    protected $ui;

    /**
     * What to show inside button when on if custom ui is used
     *
     * @var string
     */
    protected $ui_on_text;

    /**
     * What to show inside button when off if custom ui is used
     *
     * @var string
     */
    protected $ui_off_text;

    /**
     * What type the RediPress index field should be.
     *
     * @var string
     */
    protected $redipress_field_type = 'Numeric';

    /**
     * Set message
     *
     * @param string $message New message.
     * @return self
     */
    public function set_message( string $message ) {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function get_message() {
        return $this->message;
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
     * Set button on text
     *
     * @param string $text Text to show.
     * @return self
     */
    public function set_ui_on_text( string $text ) {
        $this->ui_on_text = $text;

        return $this;
    }

    /**
     * Get button on text
     *
     * @return string
     */
    public function get_ui_on_text() {
        return $this->ui_on_text;
    }

    /**
     * Set button off text
     *
     * @param string $text Text to show.
     * @return self
     */
    public function set_ui_off_text( string $text ) {
        $this->ui_off_text = $text;

        return $this;
    }

    /**
     * Get button off text
     *
     * @return string
     */
    public function get_ui_off_text() {
        return $this->ui_off_text;
    }
}
