<?php
namespace Geniem\ACF\Field;

class CloneField extends \Geniem\ACF\Field {
    protected $type = 'clone';

    protected $display = 'seamless';

    protected $layout = 'block';

    protected $prefix_label = 0;

    protected $prefix_name = 0;

    protected $clone;

    public function export() {
        $obj = get_object_vars( $this );

        $obj['clone'] = array_map( function( $clone ) {
            if ( is_string( $clone ) ) {
                return $clone;
            }
            else {
                return $clone->get_name();
            }
        }, $obj['clone'] );

        return $obj;
    }

    public function set_display_mode( string $display_mode = 'seamless' ) {
        if ( ! in_array( $display_mode, [ 'seamless', 'group' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_display_mode() does not accept argument "' . $display_mode .'"' );
        }

        $this->display = $display_mode;

        return $this;
    }

    public function get_display_mode() {
        return $this->display;
    }

    public function set_layout( string $layout = 'block' ) {
        if ( ! in_array( $layout, [ 'block', 'table', 'row' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_layout() does not accept argument "' . $layout .'"' );
        }

        $this->layout = $layout;

        return $this;
    }

    public function get_layout() {
        return $this->layout;
    }

    public function set_label_prefix() {
        $this->prefix_label = 1;

        return $this;
    }

    public function remove_label_prefix() {
        $this->prefix_label = 0;

        return $this;
    }

    public function get_label_prefix() {
        return $this->prefix_label;
    }

    public function set_name_prefix() {
        $this->prefix_name = 1;

        return $this;
    }

    public function remove_name_prefix() {
        $this->prefix_name = 0;

        return $this;
    }

    public function get_name_prefix() {
        return $this->prefix_name;
    }

    public function add_clone( $clone ) {
        if ( ! ( $clone instanceof \Geniem\ACF\Field || $clone instanceof \Geniem\ACF\Group || is_string( $clone ) ) ) {
            throw new Exception ( 'Geniem\ACF\Field\Clone: add_clone() requires an argument that is a string or type "\Geniem\ACF\Field" or "\Geniem\ACF\Group"' );
        }

        if ( is_string( $clone ) ) {
            $name = $clone;
        }
        else {
            $name = $clone->get_name();
        }

        $this->clone[ $name ] = $clone;

        $this->clone = array_unique( $this->clone );

        return $this;
    }

    public function remove_clone( $clone ) {
        if ( ! ( $clone instanceof \Geniem\ACF\Field || $clone instanceof \Geniem\ACF\Group || is_string( $clone ) ) ) {
            throw new Exception ( 'Geniem\ACF\Field\Clone: remove_clone() requires an argument that is a string or type "\Geniem\ACF\Field" or "\Geniem\ACF\Group"' );
        }

        if ( is_string( $clone ) ) {
            $name = $clone;
        }
        else {
            $name = $clone->get_name();
        }

        unset( $this->clone[ $name ] );

        return $this;
    }

    public function get_clones() {
        return $this->clone;
    }
}
