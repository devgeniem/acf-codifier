<?php
/**
 * ACF Codifier DateTimePicker field
 */

namespace Geniem\ACF\Field;

/**
 * Class DateTimePicker
 */
class DateTimePicker extends DatePicker {

    /**
     * The field type
     *
     * @var string date_time_picker
     */
    protected $type = 'date_time_picker';

    /**
     * Display format that user sees
     *
     * @var string
     */
    protected $display_format = 'd/m/Y g:i a';

    /**
     * Format when returned via get_field
     *
     * @var string
     */
    protected $return_format = 'd/m/Y g:i a';
}
