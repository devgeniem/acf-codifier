<?php
/**
 * Acf codifier image field
 */

namespace Geniem\ACF\Field;

/**
 * Class Image
 */
class Image extends \Geniem\ACF\Field {

    use Common\Image;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'image';

    /**
     * Return format
     *
     * @var string
     */
    protected $return_format;

    /**
     * Sets return format
     *
     * @throws \Geniem\ACF\Exception Throws error if format is not valid.
     * @param string $format Format in which acf should return the value.
     * @return self
     */
    public function set_return_format( string $format = 'array' ) {
        if ( ! in_array( $format, [ 'array', 'url', 'id' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_return_format() does not accept argument "' . $format . '"' );
        }

        $this->return_format = $format;

        return $this;
    }

    /**
     * Get return format
     *
     * @return string Return format
     */
    public function get_return_format() {
        return $this->return_format;
    }
}
