<?php
namespace Geniem\ACF\Field;

class TrueFalse extends Field {
    protected $type = 'true_false';

    protected $message;

    public function set_message( string $message ) {
        $this->message = $message;

        return $this;
    }

    public function get_message() {
        return $this->message;
    }
}