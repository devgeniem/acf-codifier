<?php
namespace Geniem\ACF\Field;

class Oembed extends \Geniem\ACF\Field {
    protected $type = 'oembed';

    protected $width;

    protected $height;

    public function set_width( string $width ) {
        $this->width = $width;

        return $this;
    }

    public function get_width() {
        return $this->width;
    }

    public function set_height( string $height ) {
        $this->height = $height;

        return $this;
    }

    public function get_height() {
        return $this->height;
    }
}
