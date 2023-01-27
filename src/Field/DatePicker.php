<?php
/**
 * ACF Codifier DatePicker field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\ReadonlyTrait;

/**
 * Class DatePicker
 */
class DatePicker extends \Geniem\ACF\Field {

    use Disabled, ReadonlyTrait;

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
    protected $display_format = 'd/m/Y';

    /**
     * Format when returned via get_field
     *
     * @var string
     */
    protected $return_format = 'd/m/Y';

    /**
     * First day to show in datepicker
     *
     * @var integer
     */
    protected $first_day = 1;

    /**
     * What type the RediPress index field should be.
     *
     * @var string
     */
    protected $redipress_field_type = 'Numeric';

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        parent::__construct( $label, $key, $name );

        $this->redipress_queryable_filter = 'strtotime';
    }

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
