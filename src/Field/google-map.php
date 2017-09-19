<?php
namespace Geniem\ACF\Field;

class GoogleMap extends Field {

    protected $type = 'google_map';

    protected $center_lat;

    protected $center_lng;

    protected $zoom;

    protected $height;

    public function set_center_lat( int $lat ) {
        $this->center_lat = $lat;

        return $this;
    }

    public function get_center_lat() {
        return $this->center_lat;
    }

    public function set_center_lng( int $lng ) {
        $this->center_lng = $lng;

        return $this;
    }

    public function get_center_lng() {
        return $this->center_lng;
    }

    public function set_zoom( int $zoom ) {
        $this->zoom = $zoom;

        return $this;
    }

    public function get_zoom() {
        return $this->zoom;
    }

    public function set_height( int $height ) {
        $this->height = $height;

        return $this;
    }

    public function get_height() {
        return $this->height;
    }
}
