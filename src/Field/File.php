<?php
/**
 * ACF Codifier file class.
 */

namespace Geniem\ACF\Field;

/**
 * Class File
 */
class File extends \Geniem\ACF\Field {
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
     * The preview size of the field.
     * Allowed values are WordPress' image sizes.
     *
     * @var string
     */
    protected $preview_size = 'thumbnail';

    /**
     * The target library to be used.
     *
     * @var string
     */
    protected $library = 'all';

    /**
     * Minimum size for the file.
     *
     * @var string
     */
    protected $min_size;

    /**
     * Maximum size for the file.
     *
     * @var string
     */
    protected $max_size;

    /**
     * Allowed MIME types for the file.
     *
     * @var array
     */
    protected $mime_types = [];

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

    /**
     * Set the preview size of the field.
     *
     * @param string $preview_size Preview size.
     * @return self
     */
    public function set_preview_size( string $preview_size = 'thumbnail' ) {
        $this->preview_size = $preview_size;

        return $this;
    }

    /**
     * Get the preview size of the field.
     *
     * @return string
     */
    public function get_preview_size() {
        return $this->preview_size;
    }

    /**
     * Set the target library of the field.
     *
     * @param string $library        Target library.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
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
     * Get the target library of the field.$_COOKIE
     *
     * @return string
     */
    public function get_library() {
        return $this->library;
    }

    /**
     * Set the minimum size of the file.
     *
     * @param string $min_size Minimum size.
     * @return self
     */
    public function set_min_size( string $min_size ) {
        $this->min_size = $min_size;

        return $this;
    }

    /**
     * Get the minimum size of the file.
     *
     * @return string
     */
    public function get_min_size() {
        return $this->min_size;
    }

    /**
     * Set the maximum size of the file.
     *
     * @param string $max_size Maximum size.
     * @return self
     */
    public function set_max_size( string $max_size ) {
        $this->max_size = $max_size;

        return $this;
    }

    /**
     * Get the maximum size of the file.
     *
     * @return string
     */
    public function get_max_size() {
        return $this->max_size;
    }

    /**
     * Set allowed MIME types for the file.
     *
     * @param array $mime_types Allowed MIME types.
     * @return self
     */
    public function set_mime_types( array $mime_types ) {
        $this->mime_types = $mime_types;

        return $this;
    }

    /**
     * Add an allowed MIME type for the file
     *
     * @param string $mime_type Allowed MIME type.
     * @return self
     */
    public function add_mime_type( string $mime_type ) {
        $this->mime_types[] = $mime_type;

        $this->mime_types = array_unique( $this->mime_types );

        return $this;
    }

    /**
     * Remove an allowed MIME type from the field.
     *
     * @param string $mime_type MIME type to remove.
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
     * Get allowed MIME types.
     *
     * @return array
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
            'filter'        => 'acf/validate_attachment/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 4,
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
            'filter'        => 'acf/upload_prefilter/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 3,
        ];

        return $this;
    }
}
