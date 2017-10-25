<?php
/**
 * Layout class for the flexible field
 */

namespace Geniem\ACF\Field\Flexible;

/**
 * Class Layout
 */
class Layout {
    /**
     * Layout label
     *
     * @var string
     */
    protected $label;

    /**
     * Layout key
     *
     * @var string
     */
    protected $key;

    /**
     * Layout name
     *
     * @var string
     */
    protected $name;

    /**
     * Layout subfields
     *
     * @var array
     */
    protected $subfields;

    /**
     * Display mode
     *
     * @var string
     */
    protected $display = 'block';

    /**
     * Constructor
     *
     * @param string      $label Layout label.
     * @param string|null $key   Layout key.
     * @param string|null $name  Layout name.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        $this->label = $label;

        $this->key = $key ?? sanitize_title( $label );

        $this->name = $name ?? sanitize_title( $label );

        $this->active = 1;
    }

    /**
     * Prevent raw cloning.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param  string      $key  New field key.
     * @param  string|null $name New field name.
     * @return Geniem\ACF\Field
     */
    public function clone( $key, string $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->reset();

        return $clone;
    }

    /**
     * Export field in ACF's native format.
     *
     * @return array Exported acf compatible version
     */
    public function export() {
        $obj = get_object_vars( $this );

        if ( ! empty( $obj['sub_fields'] ) ) {
            $obj['sub_fields'] = array_map( function( $field ) {
                return $field->export();
            }, $obj['sub_fields'] );

            $obj['sub_fields'] = array_values( $obj['sub_fields'] );
        }

        return $obj;
    }

    /**
     * Set label
     *
     * @param string $label New label.
     * @return self
     */
    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string Label
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Set key
     *
     * @param string $key New key.
     * @return self
     */
    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string Key
     */
    public function get_key() {
        return $this->key;
    }

    /**
     * Set name
     *
     * @param string $name New name.
     * @return self
     */
    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string Name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Add field to layout
     *
     * @throws \Geniem\ACF\Exception Throw error if given field is not valid.
     * @param \Geniem\ACF\Field $field A field to be added.
     * @return self
     */
    public function add_field( \Geniem\ACF\Field $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: add_field() requires an argument that is of type "\Geniem\ACF\Field"' );
        }

        $this->sub_fields[ $field->get_name() ] = $field;

        return $this;
    }

    /**
     * Remove field from sub fields
     *
     * @param  string $name Field name.
     * @return self
     */
    public function remove_field( string $name ) {
        if ( isset( $this->sub_fields[ $name ] ) ) {
            unset( $this->sub_fields[ $name ] );
        }

        return $this;
    }

    /**
     * Get sub field by name
     *
     * @param  string $name Field name.
     * @return \Geniem\ACF\Field $name Field name.
     */
    public function get_field( string $name ) {
        return $this->subfields[ $name ];
    }

    /**
     * Get all sub fields
     *
     * @return array Fields
     */
    public function get_fields() {
        return $this->subfields;
    }

    /**
     * Set display mode
     *
     * @param string $display_mode Display mode to set.
     * @throws \Geniem\ACF\Field Info about invalid display mode.
     * @return self
     */
    public function set_display_mode( string $display_mode = 'block' ) {
        if ( ! in_array( $display_mode, [ 'block', 'table', 'row' ] ) ) {
            throw new \Geniem\ACF\Field( 'Geniem\ACF\FlexibleLayout: set_display_mode() does not accept argument "' . $display_mode . '"' );
        }

        $this->display = $display_mode;

        return $this;
    }
}
