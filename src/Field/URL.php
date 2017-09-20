<?php
namespace Geniem\ACF\Field;

class URL extends \Geniem\ACF\Field {
    protected $type = 'url';

    protected $placeholder;

    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function get_placeholder() {
        return $this->placeholder;
    }
}
