<?php
namespace Geniem\ACF\Field;

class Relationship extends Field {
    protected $type = 'relationship';
    
    protected $post_type;

    protected $taxonomy;

    protected $filters;

    protected $elements;

    protected $min;

    protected $max;

    protected $return_format;

    public function set_post_types( $post_types ) {
        if ( ! is_array( $post_types ) ) {
            throw new Exception ('Geniem\ACF\Group: set_post_types() requires an array as an argument' );
        }

        $this->post_type = $post_types;

        return $this;
    }

    public function add_post_type( $post_type ) {
        $this->post_type[] = $post_type;

        $this->post_type = array_unique( $this->post_type );

        return $this;
    }

    public function remove_post_type( $post_type ) {
        $position = array_search( $post_type, $this->post_type );

        if ( ( $position !== false ) ) {
            unset( $this->post_type[ $position ] );
        }

        return $this;
    }

    public function get_post_types() {
        return $this->post_type;
    }

    public function set_taxonomies( $taxonomies ) {
        if ( ! is_array( $taxonomies ) ) {
            throw new Exception ('Geniem\ACF\Group: set_taxonomies() requires an array as an argument' );
        }

        $this->taxonomy = $taxonomies;

        return $this;
    }

    public function add_taxonomy( $taxonomy ) {
        $this->taxonomy[] = $taxonomy;

        $this->taxonomy = array_unique( $this->taxonomy );

        return $this;
    }

    public function remove_taxonomy( $taxonomy ) {
        $position = array_search( $taxonomy, $this->taxonomy );

        if ( ( $position !== false ) ) {
            unset( $this->taxonomy[ $position ] );
        }

        return $this;
    }

    public function get_taxonomies() {
        return $this->taxonomy;
    }

    public function set_filters( $filters ) {
        if ( ! is_array( $filters ) ) {
            throw new Exception ('Geniem\ACF\Group: set_filters() requires an array as an argument' );
        }

        $this->filters = $filters;

        return $this;
    }

    public function add_filter( $filter ) {
        $this->filters[] = $filter;

        $this->filters = array_unique( $this->filters );

        return $this;
    }

    public function remove_filter( $filter ) {
        $position = array_search( $filter, $this->filters );

        if ( ( $position !== false ) ) {
            unset( $this->filters[ $position ] );
        }

        return $this;
    }

    public function get_filters() {
        return $this->filters;
    }

    public function set_elements( $elements ) {
        if ( ! is_array( $elements ) ) {
            throw new Exception ('Geniem\ACF\Group: set_elements() requires an array as an argument' );
        }

        $this->elements = $elements;

        return $this;
    }

    public function add_element( $element ) {
        $this->elements[] = $element;

        $this->elements = array_unique( $this->elements );

        return $this;
    }

    public function remove_element( $element ) {
        $position = array_search( $element, $this->elements );

        if ( ( $position !== false ) ) {
            unset( $this->elements[ $position ] );
        }

        return $this;
    }

    public function get_elements() {
        return $this->elements;
    }

    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    public function get_min() {
        return $this->min;
    }

    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    public function get_max() {
        return $this->max;
    }

    public function set_return_format( string $return_format = 'object' ) {
        if ( ! in_array( $return_format, [ 'object', 'id' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_return_format() does not accept argument "' . $return_format .'"' );
        }

        $this->return_format = $return_format;

        return $this;
    }

    public function get_return_format() {
        return $this->return_format;
    }
}