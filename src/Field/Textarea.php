<?php
namespace Geniem\ACF\Field;

class Textarea extends Field {
    protected $type = 'textarea';

    protected $placeholder;

    protected $maxlength;

    protected $new_lines;

    protected $rows;

    protected $readonly;

    protected $disabled;

    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function get_placeholder() {
        return $this->placeholder;
    }

    public function set_maxlength( int $maxlength ) {
        $this->maxlength = $maxlength;

        return $this;
    }

    public function set_new_lines( string $new_lines = 'wpautop' ) {
        if ( ! in_array( $new_lines, [ 'wpautop', 'br', '' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_new_lines() does not accept argument "' . $new_lines .'"' );
        }

        $this->new_lines = $new_lines;

        return $this;
    }

    public function get_new_lines() {
        return $this->new_lines;
    }

    public function set_rows( int $rows ) {
        $this->rows = $rows;

        return $this;
    }

    public function get_rows() {
        return $this->rows;
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

        return $†his;
    }

    public function get_disabled() {
        return $this->disabled;
    }
}