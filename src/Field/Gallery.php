<?php
/**
 * ACF Codifier gallery class
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\Image;
use Geniem\ACF\Field\Common\MinMax;

/**
 * Class Gallery
 */
class Gallery extends \Geniem\ACF\Field {

    use Image, MinMax;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'gallery';
}
