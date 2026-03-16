<?php
/**
 * ACF Codifier number field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\AppendPrepend;
use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\MinMax;
use Geniem\ACF\Field\Common\Placeholder;
use Geniem\ACF\Field\Common\ReadonlyTrait;

/**
 * Class Number
 */
class Number extends \Geniem\ACF\Field {

    use ReadonlyTrait, Disabled, Placeholder, AppendPrepend, MinMax;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'number';

    /**
     * Field step size
     *
     * @var integer
     */
    protected $step;

    /**
     * What type the RediPress index field should be.
     *
     * @var string
     */
    protected $redipress_field_type = 'Numeric';

    /**
     * Set step size
     *
     * @param integer|float $step Step size.
     * @return self
     */
    public function set_step( $step ) {
        // Validate that the step is an integer or a float
        if ( ! is_int( $step ) && ! is_float( $step ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Number: set_step() only accepts integers or floats' );
        }

        // Ensure the step is positive
        if ( $step <= 0 ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Number: set_step() only accepts positive values' );
        }

        $this->step = $step;

        return $this;
    }

    /**
     * Get step size
     *
     * @return integer|float
     */
    public function get_step() {
        return $this->step;
    }
}
