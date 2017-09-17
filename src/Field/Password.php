<?php
namespace Geniem\ACF\Field;

class Password extends Field {
    protected $type = 'password';

    protected $placeholder;

    protected $prepend;

    protected $append;

    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function get_placeholder() {
        return $this->placeholder;
    }

    public function set_prepend( string $prepend ) {
        $this->prepend = $prepend;

        return $this;
    }

    public function get_prepend() {
        return $this->prepend;
    }

    public function set_append( string $append ) {
        $this->append = $append;

        return $this;
    }

    public function get_append() {
        return $this->append;
    }
}