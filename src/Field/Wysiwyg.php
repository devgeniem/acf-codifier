<?php
namespace Geniem\ACF\Field;

class Wysiwyg extends \Geniem\ACF\Field {
    protected $type = 'wysiwyg';

    protected $tabs;

    protected $toolbar;

    protected $media_upload;

    public function set_tabs( string $tabs = 'all' ) {
        if ( ! in_array( $tabs, [ 'all', 'visual', 'text' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_tabs() does not accept argument "' . $tabs .'"' );
        }

        $this->tabs = $tabs;

        return $this;
    }

    public function get_tabs() {
        return $this->tabs;
    }

    public function set_toolbar( string $toolbar = 'full' ) {
        $this->toolbar = $toolbar;

        return $this;
    }

    public function get_toolbar() {
        return $this->toolbar;
    }

    public function set_media_upload( boolean $media_upload ) {
        if ( ! in_array( $media_upload, [ 'wpautop', 'br', '' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_media_upload() does not accept argument "' . $media_upload .'"' );
        }

        $this->media_upload = $media_upload;

        return $this;
    }

    public function get_media_upload() {
        return $this->media_upload;
    }
}
