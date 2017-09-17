<?php
namespace Geniem\ACF\Field;

class Number extends \Geniem\ACF\Field {
    protected $type = 'number';

    protected $placeholder;

    protected $prepend;

    protected $append;

    protected $min;

    protected $max;

    protected $step;

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

    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    public function get_max() {
        return $this->max;
    }

    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    public function get_min() {
        return $this->min;
    }

    public function set_step( int $step ) {
        $this->step = $step;

        return $this;
    }

    public function get_step() {
        return $this->step;
    }
}