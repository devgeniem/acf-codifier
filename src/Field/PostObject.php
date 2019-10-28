<?php
/**
 * Acf codifier post object field
 */

namespace Geniem\ACF\Field;

/**
 * Class PostObject
 */
class PostObject extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'post_object';

    /**
     * Can this field be left empty
     *
     * @var integer
     */
    protected $allow_null;

    /**
     * Should this field contain multiple values
     *
     * @var integer
     */
    protected $multiple;

    /**
     * Should newer ui be used for this field
     *
     * @var integer
     */
    protected $ui;

    /**
     * Should ajax be used for this field
     *
     * @var integer
     */
    protected $ajax;

    /**
     * Shown post types
     *
     * @var array
     */
    protected $added_post_types = [];

    /**
     * Excluded post types
     *
     * @var array
     */
    protected $removed_post_types = [];

    /**
     * What taxonomies should be shown
     *
     * @var array
     */
    protected $taxonomy;

    /**
     * Return format to set
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
    public function export( bool $register = false ) : array {

        // Call the parent's export method
        $obj = parent::export( $register );

        // Handle the post type functionality
        if ( ! empty( $this->added_post_types ) ) {
            $obj['post_type'] = $this->added_post_types;

            if ( ! empty( $this->removed_post_types ) ) {
                $obj['post_type'] = array_diff( $obj['post_type'], $this->removed_post_types );
            }
        }
        elseif ( ! empty( $this->removed_post_types ) ) {
            $post_types = get_post_types();

            $obj['post_type'] = array_diff( $post_types, $this->removed_post_types );
        }

        unset( $obj['added_post_types'] );
        unset( $obj['removed_post_types'] );

        return $obj;
    }

    /**
     * Allow null value
     *
     * @return self
     */
    public function allow_null() {
        $this->allow_null = 1;

        return $this;
    }

    /**
     * Disallow null value
     *
     * @return self
     */
    public function disallow_null() {
        $this->allow_null = 0;

        return $this;
    }

    /**
     * Get allow null status
     *
     * @return integer
     */
    public function get_allow_null() {
        return $this->allow_null;
    }

    /**
     * Allow multiple values
     *
     * @return self
     */
    public function allow_multiple() {
        $this->multiple = 1;

        return $this;
    }

    /**
     * Disallow multiple values
     *
     * @return self
     */
    public function disallow_multiple() {
        $this->multiple = 0;

        return $this;
    }

    /**
     * Get allow multiple status
     *
     * @return integer
     */
    public function get_allow_multiple() {
        return $this->multiple;
    }

    /**
     * Set post types to show
     *
     * @throws \Geniem\ACF\Exception Throws error if $post_types is not valid.
     * @param array $post_types An array of post type names.
     * @return self
     */
    public function set_post_types( array $post_types ) {
        if ( ! is_array( $post_types ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_post_types() requires an array as an argument' );
        }

        $this->added_post_types = $post_types;

        return $this;
    }

    /**
     * Set post types to not show
     *
     * @throws \Geniem\ACF\Exception Throws error if $post_types is not valid.
     * @param array $post_types An array of post type names.
     * @return self
     */
    public function set_removed_post_types( array $post_types ) {
        if ( ! is_array( $post_types ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_post_types() requires an array as an argument' );
        }

        $this->removed_post_types = $post_types;

        return $this;
    }

    /**
     * Add a post type to allowed post types
     *
     * @param string $post_type Post type to add.
     * @return self
     */
    public function add_post_type( string $post_type ) {
        $this->added_post_types[] = $post_type;

        $this->added_post_types = array_unique( $this->added_post_types );

        // Remove the added post type from the removed post types array
        $this->removed_post_types = array_diff( $this->removed_post_types, [ $post_type ] );

        return $this;
    }

    /**
     * Remove post type by name from allowed
     *
     * @param  string $post_type Post type name.
     * @return self
     */
    public function remove_post_type( $post_type ) {
        $this->removed_post_types[] = $post_type;

        $this->removed_post_types = array_unique( $this->removed_post_types );

        // Remove the removed post type from the added post types array
        $this->added_post_types = array_diff( $this->added_post_types, [ $post_type ] );

        return $this;
    }

    /**
     * Get added post types
     *
     * @return array
     */
    public function get_added_post_types() {
        return $this->added_post_types;
    }

    /**
     * Get removed post types
     *
     * @return array
     */
    public function get_removed_post_types() {
        return $this->removed_post_types;
    }

    /**
     * Set taxonomies to show
     *
     * @throws \Geniem\ACF\Exception Throws error if $taxonomies is not valid.
     * @param array $taxonomies An array of taxonomies.
     * @return self
     */
    public function set_taxonomies( $taxonomies ) {
        if ( ! is_array( $taxonomies ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_taxonomies() requires an array as an argument' );
        }

        $this->taxonomy = $taxonomies;

        return $this;
    }

    /**
     * Add an allowed taxonomy
     *
     * @param string $taxonomy Taxonomy slug.
     * @return self
     */
    public function add_taxonomy( $taxonomy ) {
        $this->taxonomy[] = $taxonomy;

        $this->taxonomy = array_unique( $this->taxonomy );

        return $this;
    }

    /**
     * Remove taxonomy from allowed by slug
     *
     * @param  string $taxonomy Taxonomy slug.
     * @return self
     */
    public function remove_taxonomy( $taxonomy ) {
        $position = array_search( $taxonomy, $this->taxonomy, true );

        if ( ( $position !== false ) ) {
            unset( $this->taxonomy[ $position ] );
        }

        return $this;
    }

    /**
     * Get allowed taxonomies
     *
     * @return array
     */
    public function get_taxonomies() {
        return $this->taxonomy;
    }

    /**
     * Set return format
     *
     * @throws \Geniem\ACF\Exception Throws error if $return_format is not valid.
     * @param string $return_format Return format to use.
     * @return self
     */
    public function set_return_format( string $return_format = 'object' ) {
        if ( ! in_array( $return_format, [ 'object', 'id' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\PostObject: set_return_format() does not accept argument "' . $return_format . '"' );
        }

        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Get return format
     *
     * @return string
     */
    public function get_return_format() {
        return $this->return_format;
    }

    /**
     * Enable loading values via ajax
     *
     * @return self
     */
    public function use_ajax() {
        $this->ajax = 1;

        return $this;
    }

    /**
     * Disable loading values via ajax
     *
     * @return self
     */
    public function no_ajax() {
        $this->ajax = 0;

        return $this;
    }

    /**
     * Get ajax loading state
     *
     * @return integer
     */
    public function get_ajax() {
        return $this->ajax;
    }

    /**
     * Register a post object query filtering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function post_object_query( callable $function ) {
        $this->filters['post_object_query'] = [
            'filter'        => 'acf/fields/post_object/query/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 3,
        ];

        return $this;
    }

    /**
     * Register a post object result filtering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function post_object_result( callable $function ) {
        $this->filters['post_object_result'] = [
            'filter'        => 'acf/fields/post_object/result/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 4,
        ];

        return $this;
    }
}
