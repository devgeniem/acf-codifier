<?php
namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\AppendPrepend;
use Geniem\ACF\Field\Common\Placeholder;

class Password extends \Geniem\ACF\Field {

    use Placeholder, AppendPrepend;

    /**
     * The field type.
     *
     * @var string
     */
    protected $type = 'password';
}
