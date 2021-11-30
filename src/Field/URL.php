<?php
/**
 * Acf codifier url field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\Placeholder;
use Geniem\ACF\Field\Common\ReadonlyTrait;

/**
 * Class URL
 */
class URL extends \Geniem\ACF\Field {

    use ReadonlyTrait, Disabled, Placeholder;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'url';
}
