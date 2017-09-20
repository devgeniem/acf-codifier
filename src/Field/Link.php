<?php
/**
 * ACF Codifier link field.
 */

namespace Geniem\ACF\Field;

/**
 * Class Link
 */
class Link extends Field {
    /**
     * Field type.
     *
     * @var string link
     */
    protected $type = 'link';

    /**
     * Field's return format.
     *
     * @var string
     */
    protected $return_format;

    /**
     * Set the return format of the field.
     *
     * @throws Exception Info about incorrect format.
     * @param string $format The return format of the field.
     * @return self
     */
    public function set_return_format( string $format ) {
        if ( ! in_array( $format, [ 'array', 'url' ] ) ) {
            throw new Exception( 'Geniem\ACF\Field\Link: set_return_format() does not accept argument "' . $type . '"' );
        }

        $this->return_format = $format;

        return $this;
    }

    /**
     * Get the placeholder of the field.
     *
     * @return string
     */
    public function get_return_format() {
        return $this->return_format;
    }
}
