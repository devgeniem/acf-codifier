<?php
/**
 * Acf codifier image field
 */

namespace Geniem\ACF\Field;

/**
 * Class Image
 */
class Image extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'image';

    /**
     * What size to show in preview
     *
     * @var string
     */
    protected $preview_size;

    /**
     * Which library to show images from
     *
     * @var string
     */
    protected $library;

    /**
     * Minimum width
     *
     * @var integer
     */
    protected $min_width;

    /**
     * Minimum height
     *
     * @var integer
     */
    protected $min_height;

    /**
     * Minimum image size
     *
     * @var string
     */
    protected $min_size;

    /**
     * Max width
     *
     * @var integer
     */
    protected $max_width;

    /**
     * Max height
     *
     * @var integer
     */
    protected $max_height;

    /**
     * Maximum image size
     *
     * @var string
     */
    protected $max_size;

    /**
     * Image mime types
     *
     * @var array
     */
    protected $mime_types;

    /**
     * Return format
     *
     * @var string
     */
    protected $return_format;

    /**
     * Export field in ACF's native format.
     *
     * @param boolean $register Whether the field is to be registered.
     *
     * @return array
     */
    public function export( $register = false ) {
        // Call the original export method
        $obj = parent::export( $register );

        // Convert the mime type array to a comma-separated list
        $obj['mime_types'] = implode( ',', $obj['mime_types'] );

        return $obj;
    }

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

    /**
     * Set preview size
     *
     * @param string $preview_size Preview size.
     * @return self
     */
    public function set_preview_size( string $preview_size = 'thumbnail' ) {
        $this->preview_size = $preview_size;

        return $this;
    }

    /**
     * Get preview size
     *
     * @return string Preview size
     */
    public function get_preview_size() {
        return $this->preview_size;
    }

    /**
     * Sets library
     *
     * @throws \Geniem\ACF\Exception Throws error if library is not valid.
     * @param string $library Library to use.
     * @return self
     */
    public function set_library( string $library = 'all' ) {
        if ( ! in_array( $library, [ 'all', 'uploadedTo' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_library() does not accept argument "' . $library . '"' );
        }

        $this->library = $library;

        return $this;
    }

    /**
     * Get library
     *
     * @return string Library
     */
    public function get_library() {
        return $this->library;
    }

    /**
     * Set minimum width
     *
     * @param integer $min_width Minimum width.
     * @return self
     */
    public function set_min_width( int $min_width ) {
        $this->min_width = $min_width;

        return $this;
    }

    /**
     * Get minimum width
     *
     * @return integer Minimum width
     */
    public function get_min_width() {
        return $this->min_width;
    }

    /**
     * Set minimum height
     *
     * @param integer $min_height Minimum height.
     * @return self
     */
    public function set_min_height( int $min_height ) {
        $this->min_height = $min_height;

        return $this;
    }

    /**
     * Get minimum height
     *
     * @return integer Minimum height
     */
    public function get_min_height() {
        return $this->min_height;
    }

    /**
     * Set minimum size
     *
     * @param string $min_size Minimum size.
     * @return self
     */
    public function set_min_size( string $min_size ) {
        $this->min_size = $min_size;

        return $this;
    }

    /**
     * Get minimum size
     *
     * @return string Minimum size
     */
    public function get_min_size() {
        return $this->min_size;
    }

    /**
     * Set maximum width
     *
     * @param integer $max_width Maximum width.
     * @return self
     */
    public function set_max_width( int $max_width ) {
        $this->max_width = $max_width;

        return $this;
    }

    /**
     * Get maximum width
     *
     * @return integer Maximum width
     */
    public function get_max_width() {
        return $this->max_width;
    }

    /**
     * Set maximum height
     *
     * @param integer $max_height Maximum height.
     * @return self
     */
    public function set_max_height( int $max_height ) {
        $this->max_height = $max_height;

        return $this;
    }

    /**
     * Get maximum height
     *
     * @return integer Maximum height
     */
    public function get_max_height() {
        return $this->max_height;
    }

    /**
     * Set maximum size
     *
     * @param string $max_size Maximum size.
     * @return self
     */
    public function set_max_size( string $max_size ) {
        $this->max_size = $max_size;

        return $this;
    }

    /**
     * Get maximum size
     *
     * @return string Maximum size
     */
    public function get_max_size() {
        return $this->max_size;
    }

    /**
     * Set allowed mime types
     *
     * @throws \Geniem\ACF\Exception Throws error if mime_types is not an array.
     * @param array $mime_types Mime types.
     * @return self
     */
    public function set_mime_types( array $mime_types ) {
        if ( ! is_array( $mime_types ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_mime_types() requires an array as an argument' );
        }

        $this->mime_types = $mime_types;

        return $this;
    }

    /**
     * Adds a mime types to allowed mime types
     *
     * @param string $mime_type Mime type.
     * @return self
     */
    public function add_mime_type( string $mime_type ) {
        $this->mime_types[] = $mime_type;

        $this->mime_types = array_unique( $this->mime_types );

        return $this;
    }

    /**
     * Remove a mime type from allowed mime types
     *
     * @param  string $mime_type Mime type.
     * @return self
     */
    public function remove_mime_type( string $mime_type ) {
        $position = array_search( $mime_type, $this->mime_types );

        if ( ( $position !== false ) ) {
            unset( $this->mime_types[ $position ] );
        }

        return $this;
    }

    /**
     * Get mime types
     *
     * @return array Mime types
     */
    public function get_mime_types() {
        return $this->mime_types;
    }

    /**
     * Register a attachment validating function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function validate_attachment( $function ) {
        $this->filters['validate_attachment'] = [
            'filter'   => 'acf/validate_attachment/key=',
            'function' => $function,
        ];

        return $this;
    }

    /**
     * Register a upload prefiltering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function upload_prefilter( $function ) {
        $this->filters['upload_prefilter'] = [
            'filter'   => 'acf/upload_prefilter/key=',
            'function' => $function,
        ];

        return $this;
    }
}
