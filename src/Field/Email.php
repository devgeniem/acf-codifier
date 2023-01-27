<?php
/**
 * ACF Codifier email field.
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\AppendPrepend;
use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\Placeholder;
use Geniem\ACF\Field\Common\ReadonlyTrait;

/**
 * Class Email
 */
class Email extends \Geniem\ACF\Field {

    use ReadonlyTrait, Disabled, Placeholder, AppendPrepend;

    /**
     * Field type.
     *
     * @var string Email
     */
    protected $type = 'email';
}
