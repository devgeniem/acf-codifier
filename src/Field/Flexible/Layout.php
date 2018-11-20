<?php
/**
 * Layout class for the flexible field
 */

namespace Geniem\ACF\Field\Flexible;

use Geniem\ACF\Field,
    Geniem\ACF\Field\Common\Groupable;

/**
 * Class Layout
 */
class Layout {

    /**
     * Import the groupable functionalities
     */
    use Groupable;

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
    public $sub_fields = [];

    /**
     * Exclude the layout from post types
     *
     * @var array
     */
    protected $exclude_post_types;

    /**
     * Exclude the layout from templates
     *
     * @var array
     */
    protected $exclude_templates;

    /**
     * Exclude the layout from certain Flexible Content fields
     *
     * @var array
     */
    protected $exclude_fields;

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
     * @return Field
     */
    public function clone( $key, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        return $clone;
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
     * Set display mode
     *
     * @param string $display_mode Display mode to set.
     * @throws \Geniem\ACF\Exception Info about invalid display mode.
     * @return self
     */
    public function set_display_mode( string $display_mode = 'block' ) {
        if ( ! in_array( $display_mode, [ 'block', 'table', 'row' ], true ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\FlexibleLayout: set_display_mode() does not accept argument "' . $display_mode . '"' );
        }

        $this->display = $display_mode;

        return $this;
    }

    /**
     * Exclude the post type.
     *
     * @param string $post_type The post type to exclude this layout from.
     * @return self
     */
    public function exclude_post_type( string $post_type ) {
        $this->exclude_post_types[] = $post_type;

        $this->exclude_post_types = array_unique( $this->exclude_post_types );

        return $this;
    }

    /**
     * Set all post types to exclude.
     *
     * @param array $post_types The post types to exclude this layout from.
     * @return self
     */
    public function set_excluded_post_types( array $post_types ) {
        $this->exclude_post_types = $post_types;

        return $this;
    }

    /**
     * Remove a post type from the excluded post types list.
     *
     * @param string $post_type The post type to remove from the excluded list.
     * @return self
     */
    public function remove_excluded_post_type( string $post_type ) {
        unset( $this->exclude_post_types[ $post_type ] );

        return $this;
    }

    /**
     * Get the list of excluded post types.
     *
     * @return array Excluded post types.
     */
    public function get_excluded_post_types() {
        return $this->exclude_post_types;
    }

    /**
     * Exclude a template.
     *
     * @param string $template The template to exclude this layout from.
     * @return self
     */
    public function exclude_template( string $template ) {
        $this->exclude_templates[] = $template;

        $this->exclude_templates = array_unique( $this->exclude_templates );

        return $this;
    }

    /**
     * Set all templates to exclude.
     *
     * @param array $templates The templates to exclude this layout from.
     * @return self
     */
    public function set_excluded_templates( array $templates ) {
        $this->exclude_templates = $templates;

        return $this;
    }

    /**
     * Remove a template from the excluded templates list.
     *
     * @param string $template The template to remove from the excluded list.
     * @return self
     */
    public function remove_excluded_template( string $template ) {
        unset( $this->exclude_templates[ $template ] );

        return $this;
    }

    /**
     * Get the list of excluded templates.
     *
     * @return array Excluded templates.
     */
    public function get_excluded_templates() {
        return $this->exclude_templates;
    }

    /**
     * Exclude a Flexible Content field.
     *
     * @param string|object $field The field to exclude this layout from.
     * @return self
     */
    public function exclude_field( $field ) {
        if ( $field instanceof Field ) {
            $field = $field->get_name();
        }

        $this->exclude_fields[] = $field;

        $this->exclude_fields = array_unique( $this->exclude_fields );

        return $this;
    }

    /**
     * Set all fields to exclude.
     *
     * @param array $fields The fields to exclude this layout from.
     * @return self
     */
    public function set_excluded_fields( array $fields ) {
        $this->exclude_fields = $fields;

        return $this;
    }

    /**
     * Remove a field from the excluded fields list.
     *
     * @param string|object $field The field to remove from the excluded list.
     * @return self
     */
    public function remove_excluded_field( $field ) {
        if ( $field instanceof Field ) {
            $field = $field->get_name();
        }

        unset( $this->exclude_fields[ $field ] );

        return $this;
    }

    /**
     * Get the list of excluded fields.
     *
     * @return array Excluded fields.
     */
    public function get_excluded_fields() {
        return $this->exclude_fields;
    }
}
