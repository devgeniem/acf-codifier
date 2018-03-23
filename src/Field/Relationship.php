<?php
/**
 * Acf codifier relationship field
 */

namespace Geniem\ACF\Field;

/**
 * Class Relationship
 */
class Relationship extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'relationship';

    /**
     * Allowed post types
     *
     * @var array
     */
    protected $post_type = [];

    /**
     * Allowed taxonomies
     *
     * @var array
     */
    protected $taxonomy = [];

    /**
     * What filters to show
     *
     * @var array
     */
    protected $field_filters = [];

    /**
     * What elements to show
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Minimum amount of posts
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum amount of posts
     *
     * @var integer
     */
    protected $max;

    /**
     * Return format
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
    public function export( $register = false ) {
        $obj = parent::export( $register );

        $obj['filters'] = $obj['field_filters'];
        unset( $obj['field_filters'] );

        return $obj;
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

        $this->post_type = $post_types;

        return $this;
    }

    /**
     * Add a post type to allowed post types
     *
     * @param string $post_type Post type to add.
     * @return self
     */
    public function add_post_type( string $post_type ) {
        $this->post_type[] = $post_type;

        $this->post_type = array_unique( $this->post_type );

        return $this;
    }

    /**
     * Remove post type by name from allowed
     *
     * @param  string $post_type Post type name.
     * @return self
     */
    public function remove_post_type( string $post_type ) {
        $position = array_search( $post_type, $this->post_type );

        if ( ( $position !== false ) ) {
            unset( $this->post_type[ $position ] );
        }

        return $this;
    }

    /**
     * Get allowed post types
     *
     * @return array
     */
    public function get_post_types() {
        return $this->post_type;
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
        $position = array_search( $taxonomy, $this->taxonomy );

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
     * Set filters to show
     *
     * @throws \Geniem\ACF\Exception Throws error if $filters is not valid.
     * @param array $filters An array of usable filters.
     * @return self
     */
    public function set_filters( array $filters ) {
        if ( ! is_array( $filters ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_filters() requires an array as an argument' );
        }

        $this->field_filters = $filters;

        return $this;
    }

    /**
     * Add a filter
     *
     * @param string $filter Filter name.
     * @return self
     */
    public function add_filter( string $filter ) {
        $this->field_filters[] = $filter;

        $this->field_filters = array_unique( $this->filters );

        return $this;
    }

    /**
     * Remove filter by name
     *
     * @param  string $filter Filter name.
     * @return self
     */
    public function remove_filter( string $filter ) {
        $position = array_search( $filter, $this->field_filters );

        if ( ( $position !== false ) ) {
            unset( $this->field_filters[ $position ] );
        }

        return $this;
    }

    /**
     * Get usable filters
     *
     * @return array
     */
    public function get_filters() {
        return $this->field_filters;
    }

    /**
     * Set elements to show
     *
     * @throws \Geniem\ACF\Exception Throws error if $elements is not valid.
     * @param array $elements An array of elements to show.
     * @return self
     */
    public function set_elements( array $elements ) {
        if ( ! is_array( $elements ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_elements() requires an array as an argument' );
        }

        $this->elements = $elements;

        return $this;
    }

    /**
     * Add an element to show
     *
     * @param string $element Element name.
     * @return self
     */
    public function add_element( string $element ) {
        $this->elements[] = $element;

        $this->elements = array_unique( $this->elements );

        return $this;
    }

    /**
     * Remove element by name
     *
     * @param  string $element Element name.
     * @return self
     */
    public function remove_element( string $element ) {
        $position = array_search( $element, $this->elements );

        if ( ( $position !== false ) ) {
            unset( $this->elements[ $position ] );
        }

        return $this;
    }

    /**
     * Get elements to show
     *
     * @return array
     */
    public function get_elements() {
        return $this->elements;
    }

    /**
     * Set minimum value
     *
     * @param integer $min Minimum value.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum value
     *
     * @return integer Minimum value.
     */
    public function get_min() {
        return $this->min;
    }

    /**
     * Set maximum value
     *
     * @param integer $max Maximum value.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum value
     *
     * @return integer Maximum value.
     */
    public function get_max() {
        return $this->max;
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
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_return_format() does not accept argument "' . $return_format . '"' );
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
     * Register a relationship query filtering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function relationship_query( $function ) {
        $this->filters['relationship_query'] = [
            'filter'   => 'acf/fields/relationship/query/key=',
            'function' => $function,
        ];

        return $this;
    }

    /**
     * Register a relationship result filtering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function relationship_result( $function ) {
        $this->filters['relationship_result'] = [
            'filter'   => 'acf/fields/relationship/result/key=',
            'function' => $function,
        ];

        return $this;
    }

}
