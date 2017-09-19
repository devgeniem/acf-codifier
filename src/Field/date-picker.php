<?php
namespace Geniem\ACF\Field;

class DatePicker extends Field {

    protected $type = 'date_picker';

    protected $display_format;

    protected $return_format;

    protected $first_day;

    public function set_display_format( string $format ) {
        $this->display_format = $format;

        return $this;
    }

    public function get_display_format() {
        return $this->display_format;
    }

    public function set_return_format( string $format ) {
        $this->return_format = $format;

        return $this;
    }

    public function get_return_format() {
        return $this->return_format;
    }

    public function set_first_day( int $day ) {
        $this->first_day = $day;

        return $this;
    }

    public function get_first_day() {
        return $this->first_day;
    }
}
