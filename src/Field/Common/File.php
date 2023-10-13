<?php
/**
 * ACF Codifier File trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * File Trait
 */
trait File {

    /**
     * Which library to show images from
     *
     * @var string
     */
    protected $library;

    /**
     * Minimum file size
     *
     * @var string
     */
    protected $min_size;

    /**
     * Maximum file size
     *
     * @var string
     */
    protected $max_size;

    /**
     * Image mime types
     *
     * @var array
     */
    protected $mime_types = [];

    /**
     * What size to show in preview
     *
     * @var string
     */
    protected $preview_size;

    /**
     * Export field in ACF's native format.
     *
     * @param boolean $register Whether the field is to be registered.
     * @param mixed   $parent   Possible parent object.
     *
     * @return array
     */
    public function export( bool $register = false, $parent = null ) : ?array {
        // Call the original export method
        $obj = parent::export( $register, $parent );

        // Convert the mime type array to a comma-separated list
        $obj['mime_types'] = implode( ',', $obj['mime_types'] );

        return $obj;
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
     * Set allowed file extensions
     *
     * e.g. jpg, png, gif
     *
     * @throws \Geniem\ACF\Exception Throws error if mime_types is not an array.
     * @param array $mime_types File extensions.
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
     * A better named wrapper for set_mime_types()
     *
     * Sets allowed file extensions, e.g. jpg, png, gif.
     *
     * @param array $file_extensions
     * @return void
     */
    public function set_allowed_file_extensions( array $file_extensions ) {
        return $this->set_mime_types( $file_extensions );
    }

    /**
     * Adds an extension to allowed file extensions
     *
     * e.g. jpg, png, gif
     *
     * @param string $mime_type File extension.
     * @return self
     */
    public function add_mime_type( string $mime_type ) {
        $this->mime_types[] = $mime_type;

        $this->mime_types = array_unique( $this->mime_types );

        return $this;
    }

    /**
     * A better named wrapper for add_mime_type()
     *
     * Adds an extensions to allowed file extensions, e.g. jpg, png, gif
     *
     * @param string $file_extension
     * @return void
     */
    public function add_allowed_file_extension( string $file_extension ) {
        return $this->add_mime_type( $file_extension );
    }

    /**
     * Remove a file extensions from allowed file extensions
     *
     * @param  string $mime_type File extension.
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
     * A better named wrapper for remove_mime_type()
     *
     * Removes a file extension from allowed file extensions
     *
     * @param string $file_extension
     * @return void
     */
    public function remove_allowed_file_extension( string $file_extension ) {
        return $this->remove_mime_type( $file_extension );
    }

    /**
     * Get allowed file extensions
     *
     * @return array File extensions
     */
    public function get_mime_types() {
        return $this->mime_types;
    }

    /**
     * A better named wrapper for get_mime_types()
     *
     * Returns a list of allowed file extensions
     *
     * @return void
     */
    public function get_allowed_file_extensions() {
        return $this->get_mime_types();
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
     * Register a attachment validating function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function validate_attachment( callable $function ) {
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
    public function upload_prefilter( callable $function ) {
        $this->filters['upload_prefilter'] = [
            'filter'        => 'acf/upload_prefilter/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 3,
        ];

        return $this;
    }
}