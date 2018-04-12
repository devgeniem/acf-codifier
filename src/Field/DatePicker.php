<?php
/**
 * ACF Codifier DatePicker field
 */

namespace Geniem\ACF\Field;

/**
 * Class DatePicker
 */
class DatePicker extends \Geniem\ACF\Field {

    /**
     * The field type
     *
     * @var string date_picker
     */
    protected $type = 'date_picker';

    /**
     * Display format that user sees
     *
     * @var string
     */
    protected $display_format = 'dd/mm/yy';

    /**
     * Format when returned via get_field
     *
     * @var string
     */
    protected $return_format = 'yymmdd';

    /**
     * First day to show in datepicker
     *
     * @var integer
     */
    protected $first_day = 1;

    /**
     * Set display_format variable
     *
     * @param  string $format Display format.
     * @return self
     */
    public function set_display_format( string $format ) {
        $this->display_format = $format;

        return $this;
    }

    /**
     * Get display_format variable
     *
     * @return string
     */
    public function get_display_format() {
        return $this->display_format;
    }

    /**
     * Set return_format variable
     *
     * @param  string $format Return format.
     * @return self
     */
    public function set_return_format( string $format ) {
        $this->return_format = $format;

        return $this;
    }

    /**
     * Get return_format variable
     *
     * @return string
     */
    public function get_return_format() {
        return $this->return_format;
    }

    /**
     * Set first_day variable
     *
     * @param  integer $day First day.
     * @return self
     */
    public function set_first_day( int $day ) {
        $this->first_day = $day;

        return $this;
    }

    /**
     * Get first_day variable
     *
     * @return integer
     */
    public function get_first_day() {
        return $this->first_day;
    }
}
