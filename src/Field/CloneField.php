<?php
/**
 * ACF Codifier Clone field.
 */

namespace Geniem\ACF\Field;

/**
 * Class CloneField
 *
 * Named like this because 'Clone' is a reserved word in PHP.
 */
class CloneField extends \Geniem\ACF\Field {
    /**
     * Field type.
     *
     * @var string Clone.
     */
    protected $type = 'clone';

    /**
     * The field's display style
     *
     * @var string
     */
    protected $display = 'seamless';

    /**
     * The layout style of the field.
     *
     * @var string
     */
    protected $layout = 'block';

    /**
     * Whether the field label is to be prefixed.
     *
     * @var boolean
     */
    protected $prefix_label = 0;

    /**
     * Whether the field name is to be prefixed.
     *
     * @var boolean
     */
    protected $prefix_name = 1;

    /**
     * The fields or groups to be cloned.
     *
     * @var array
     */
    protected $clone;

    /**
     * Export the fields to be cloned in ACF's native format.
     *
     * @param boolean $register Whether the field is to be registered.
     * @param mixed   $parent   Possible parent object.
     *
     * @throws Exception Throws an exception if a key or a name is not defined.
     *
     * @return array
     */
    public function export( $register = false, $parent = null ) {
        if ( empty( $this->key ) ) {
            throw new Exception( 'Field ' . $this->label . ' does not have a key defined.' );
        }

        if ( empty( $this->name ) ) {
            throw new Exception( 'Field ' . $this->label . ' does not have a name defined.' );
        }

        $obj = get_object_vars( $this );

        $obj['clone'] = array_map( function( $clone ) {
            if ( is_string( $clone ) ) {
                return $clone;
            }
            else {
                return $clone->get_name();
            }
        }, $obj['clone'] );

        // Remove keys from the array.
        $obj['clone'] = array_values( $obj['clone'] );

        // Convert the wrapper class array to a space-separated string.
        if ( isset( $obj['wrapper']['class'] ) && ! empty( $obj['wrapper']['class'] ) ) {
            $obj['wrapper']['class'] = implode( ' ', $obj['wrapper']['class'] );
        }
        else {
            $obj['wrapper']['class'] = '';
        }

        return $obj;
    }

    /**
     * Set the clone field's display mode.
     *
     * @param string $display_mode   The display mode.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_display_mode( string $display_mode = 'seamless' ) {
        if ( ! in_array( $display_mode, [ 'seamless', 'group' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_display_mode() does not accept argument "' . $display_mode . '"' );
        }

        $this->display = $display_mode;

        return $this;
    }

    /**
     * Get the display mode.
     *
     * @return string
     */
    public function get_display_mode() {
        return $this->display;
    }

    /**
     * Set the clone field's layout mode.
     *
     * @param string $layout         Layout mode.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function set_layout( string $layout = 'block' ) {
        if ( ! in_array( $layout, [ 'block', 'table', 'row' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_layout() does not accept argument "' . $layout . '"' );
        }

        $this->layout = $layout;

        return $this;
    }

    /**
     * Get the field's layout mode.
     *
     * @return string
     */
    public function get_layout() {
        return $this->layout;
    }

    /**
     * Prefix the field's label.
     *
     * @return self
     */
    public function set_label_prefix() {
        $this->prefix_label = 1;

        return $this;
    }

    /**
     * Don't prefix the field's label.
     *
     * @return self
     */
    public function remove_label_prefix() {
        $this->prefix_label = 0;

        return $this;
    }

    /**
     * Get the label prefixing status.
     *
     * @return boolean
     */
    public function get_label_prefix() {
        return $this->prefix_label;
    }

    /**
     * Prefix the field's name.
     *
     * @return self
     */
    public function set_name_prefix() {
        $this->prefix_name = 1;

        return $this;
    }

    /**
     * Don't prefix the field's name.
     *
     * @return self
     */
    public function remove_name_prefix() {
        $this->prefix_name = 0;

        return $this;
    }

    /**
     * Get the name prefixing status.
     *
     * @return boolean
     */
    public function get_name_prefix() {
        return $this->prefix_name;
    }

    /**
     * Add a field or a group to be cloned.
     *
     * @param mixed $clone           A field or a field group to be cloned.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function add_clone( $clone ) {
        if ( ! ( $clone instanceof \Geniem\ACF\Field || $clone instanceof \Geniem\ACF\Group || is_string( $clone ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Clone: add_clone() requires an argument that is a string or type "\Geniem\ACF\Field" or "\Geniem\ACF\Group"' );
        }

        if ( is_string( $clone ) ) {
            $key = $clone;
        } else {
            $key = $clone->get_key();
        }

        $this->clone[ $key ] = $clone;

        $this->clone = array_unique( $this->clone );

        return $this;
    }

    /**
     * Remove a cloned item.
     *
     * @param mixed $clone           A field or a field group to be removed.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function remove_clone( $clone ) {
        if ( ! ( $clone instanceof \Geniem\ACF\Field || $clone instanceof \Geniem\ACF\Group || is_string( $clone ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Clone: remove_clone() requires an argument that is a string or type "\Geniem\ACF\Field" or "\Geniem\ACF\Group"' );
        }

        if ( is_string( $clone ) ) {
            $name = $clone;
        } else {
            $name = $clone->get_name();
        }

        unset( $this->clone[ $name ] );

        return $this;
    }

    /**
     * Get an array of cloned fields.
     *
     * @return array
     */
    public function get_clones() {
        return $this->clone;
    }

    /**
     * Clone fields do not support conditional logic
     *
     * @param mixed ...$args Any args this functions gets.
     * @throws \Geniem\ACF\Exception The exception this always throws.
     */
    public function add_conditional_logic( \Geniem\ACF\ConditionalLogicGroup $group ) {
        throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Clone: add_conditional_logic() can\'t be called on this field type.' );
    }
}
