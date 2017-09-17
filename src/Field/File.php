<?php
namespace Geniem\ACF\Field;

class File extends Field {
    protected $type = 'file';

    protected $return_format;

    protected $preview_size;

    protected $library;

    protected $min_size;
 
    protected $max_size;

    protected $mime_types;

    public function set_return_format( string $format = 'array' ) {
        if ( ! in_array( $format, [ 'array', 'url', 'id' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_return_format() does not accept argument "' . $format .'"' );
        }

        $this->return_format = $format;

        return $this;
    }

    public function get_return_format() {
        return $this->return_format;
    }

    public function set_preview_size( string $preview_size = 'thumbnail' ) {
        $this->preview_size = $preview_size;

        return $this;
    }

    public function get_preview_size() {
        return $this->preview_size;
    }

    public function set_library( string $library = 'all' ) {
        if ( ! in_array( $library, [ 'all', 'uploadedTo' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_library() does not accept argument "' . $library .'"' );
        }

        $this->library = $library;

        return $this;
    }

    public function get_library() {
        return $this->library;
    }

    public function set_min_size( string $min_size ) {
        $this->min_size = $min_size;

        return $this;
    }

    public function get_min_size() {
        return $this->min_size;
    }

    public function set_max_size( string $max_size ) {
        $this->max_size = $max_size;

        return $this;
    }

    public function get_max_size() {
        return $this->max_size;
    }

    public function set_mime_types( $mime_types ) {
        if ( ! is_array( $mime_types ) ) {
            throw new Exception ('Geniem\ACF\Group: set_mime_types() requires an array as an argument' );
        }

        $this->mime_types = $mime_types;

        return $this;
    }

    public function add_mime_type( string $mime_type ) {
        $this->mime_types[] = $mime_type;

        $this->mime_types = array_unique( $this->mime_types );

        return $this;
    }

    public function remove_mime_type( string $mime_type ) {
        $position = array_search( $mime_type, $this->mime_types );

        if ( ( $position !== false ) ) {
            unset( $this->mime_types[ $position ] );
        }

        return $this;
    }

    public function get_mime_types() {
        return $this->mime_types;
    }
}