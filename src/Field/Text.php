<?php
/**
 * Acf codifier text field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\AppendPrepend;
use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\Placeholder;
use Geniem\ACF\Field\Common\Readonly;

/**
 * Class Text
 */
class Text extends \Geniem\ACF\Field {

    use Readonly, Disabled, Placeholder, AppendPrepend;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * Max length for string
     *
     * @var integer
     */
    protected $maxlength;

    /**
     * Set text max length
     *
     * @param integer $maxlength New max length.
     * @return self
     */
    public function set_maxlength( int $maxlength ) {
        $this->maxlength = $maxlength;

        return $this;
    }
}
