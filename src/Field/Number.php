<?php
/**
 * ACF Codifier number field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\AppendPrepend;
use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\MinMax;
use Geniem\ACF\Field\Common\Placeholder;
use Geniem\ACF\Field\Common\Readonly;

/**
 * Class Number
 */
class Number extends \Geniem\ACF\Field {

    use Readonly, Disabled, Placeholder, AppendPrepend, MinMax;

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
     * @param integer $step Step size.
     * @return self
     */
    public function set_step( int $step ) {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step size
     *
     * @return integer
     */
    public function get_step() {
        return $this->step;
    }
}
