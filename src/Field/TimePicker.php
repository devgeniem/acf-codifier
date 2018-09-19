<?php
/**
 * ACF Codifier TimePicker field
 */

namespace Geniem\ACF\Field;

/**
 * Class TimePicker
 */
class TimePicker extends \Geniem\ACF\Field {

    /**
     * The field type
     *
     * @var string time_picker
     */
    protected $type = 'time_picker';

    /**
     * Display format that user sees
     *
     * @var string
     */
    protected $display_format = 'g:i a';

    /**
     * Format when returned via get_field
     *
     * @var string
     */
    protected $return_format = 'g:i a';

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
}
