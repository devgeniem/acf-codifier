<?php
namespace Geniem\ACF\Field;

class Text extends \Geniem\ACF\Field {
    protected $type = 'text';

    protected $placeholder;

    protected $prepend;

    protected $append;

    protected $maxlength;

    protected $readonly;

    protected $disabled;

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

    public function set_maxlength( int $maxlength ) {
        $this->maxlength = $maxlength;

        return $this;
    }

    public function set_readonly() {
        $this->readonly = true;

        return $this;
    }

    public function set_writable() {
        $this->readonly = false;

        return $this;
    }

    public function get_readonly() {
        return $this->readonly;
    }

    public function disable() {
        $this->disable = true;

        return $this;
    }

    public function enable() {
        $this->disable = false;

        return $this;
    }

    public function get_disabled() {
        return $this->disabled;
    }
}
