<?php
/**
 * ACF Codifier file class.
 */

namespace Geniem\ACF\Field;

/**
 * Class File
 */
class File extends \Geniem\ACF\Field {

    use Common\File;

    /**
     * Field type.
     *
     * @var string File
     */
    protected $type = 'file';

    /**
     * The return format of the field.
     *
     * @var string
     */
    protected $return_format = 'array';

    /**
     * Set the return format of the field.
     *
     * @param string $format         Return format.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
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
     * Get the return format of the field.
     *
     * @return string
     */
    public function get_return_format() {
        return $this->return_format;
    }
}
