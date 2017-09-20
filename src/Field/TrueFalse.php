<?php
namespace Geniem\ACF\Field;

class TrueFalse extends \Geniem\ACF\Field {
    protected $type = 'true_false';

    protected $message;

    protected $ui;

    protected $ui_on_text;

    protected $ui_off_text;

    public function set_message( string $message ) {
        $this->message = $message;

        return $this;
    }

    public function get_message() {
        return $this->message;
    }

    public function use_ui() {
        $this->ui = 1;
        return $this;
    }

    public function no_ui() {
        $this->ui = 0;
        return $this;
    }

    public function ui() {
        return $this->ui;
    }

    public function set_ui_on_text( string $text ) {
        $this->ui_on_text = $text;

        return $this;
    }

    public function get_ui_on_text() {
        return $this->ui_on_text;
    }

    public function set_ui_off_text( string $text ) {
        $this->ui_off_text = $text;

        return $this;
    }

    public function get_ui_off_text() {
        return $this->ui_off_text;
    }
}
