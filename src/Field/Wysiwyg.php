<?php
/**
 * Acf codifier wysiwyg field
 */

namespace Geniem\ACF\Field;

/**
 * Class Wysiwyg
 */
class Wysiwyg extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'wysiwyg';

    /**
     * What wysiwyg tabs should be shown
     *
     * @var string
     */
    protected $tabs = 'all';

    /**
     * What toolbar should be shown
     *
     * @var string
     */
    protected $toolbar = 'full';

    /**
     * Should media upload be allowed
     *
     * @var boolean
     */
    protected $media_upload = 1;

    /**
     * Delay initialization of the wysiwyg editor
     *
     * @var integer
     */
    protected $delay = 0;

    /**
     * The height of the element
     *
     * @var integer
     */
    protected $height = 300;

    /**
     * Set tabs to show
     *
     * @throws \Geniem\ACF\Exception Throws error if $tabs is not valid.
     * @param string $tabs Which tabs to allow.
     * @return self
     */
    public function set_tabs( string $tabs = 'all' ) {
        if ( ! in_array( $tabs, [ 'all', 'visual', 'text' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_tabs() does not accept argument "' . $tabs . '"' );
        }

        $this->tabs = $tabs;

        return $this;
    }

    /**
     * Get allowed tabs
     *
     * @return string
     */
    public function get_tabs() {
        return $this->tabs;
    }

    /**
     * Set what toolbars should be shown
     *
     * @param string|array|callable $toolbar Toolbar to show. Callable gets called with the field object as its parameter and should return an array.
     * @return self
     */
    public function set_toolbar( $toolbar = 'full' ) {
        if ( is_string( $toolbar ) ) {
            $this->toolbar = $toolbar;
        }
        elseif ( is_array( $toolbar ) || \is_callable( $toolbar ) ) {
            \add_filter( 'acf/fields/wysiwyg/toolbars', function( $toolbars ) use ( $toolbar ) {
                if ( is_array( $toolbar ) ) {
                    $multi_level = array_reduce( $toolbar, function( $carry, $item ) {
                        return $carry ?: is_array( $item );
                    }, false );

                    if ( ! $multi_level ) {
                        $e_toolbar = [ 1 => $toolbar ];
                    }
                    else {
                        $e_toolbar = [];

                        $i = 1;

                        foreach ( $toolbar as $row ) {
                            $e_toolbar[ $i++ ] = $row;
                        }
                    }

                    $toolbars[ 'codifier_' . sha1( $this->key ) ] = $e_toolbar;
                }
                elseif ( is_callable( $toolbar ) ) {
                    $toolbars[ 'codifier_' . sha1( $this->key ) ] = $toolbar( $this );
                }

                return $toolbars;
            }, false );

            $this->toolbar = 'codifier_' . sha1( $this->key );
        }

        return $this;
    }

    /**
     * Get what toolbars to show
     *
     * @return string
     */
    public function get_toolbar() {
        return $this->toolbar;
    }

    /**
     * Allow media upload
     *
     * @return self
     */
    public function allow_media_upload() {
        $this->media_upload = 1;

        return $this;
    }

    /**
     * Disable media upload
     *
     * @return self
     */
    public function disable_media_upload() {
        $this->media_upload = 0;

        return $this;
    }

    /**
     * Get media upload state
     *
     * @return boolean
     */
    public function get_media_upload() {
        return $this->media_upload;
    }

    /**
     * Enable delay of the wysiwyg editor initialization
     *
     * @return self
     */
    public function enable_delay() {
        $this->delay = 1;

        return $this;
    }

    /**
     * Disable delay of the wysiwyg editor initialization
     *
     * @return self
     */
    public function disable_delay() {
        $this->delay = 0;

        return $this;
    }

    /**
     * Get wysiwyg initialization delay state
     *
     * @return integer
     */
    public function get_delay() {
        return $this->delay;
    }
}