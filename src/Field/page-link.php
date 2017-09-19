<?php
namespace Geniem\ACF\Field;

class PageLink extends Field {
    protected $type = 'page_link';

    protected $multiple;

    protected $allow_null;
    
    protected $post_type;

    protected $taxonomy;

    public function allow_null() {
        $this->allow_null = 1;

        return $this;
    }

    public function disallow_null() {
        $this->allow_null = 0;

        return $this;
    }

    public function get_allow_null() {
        return $this->allow_null;
    }

    public function allow_multiple() {
        $this->multiple = 1;

        return $this;
    }

    public function disallow_multiple() {
        $this->multiple = 0;

        return $this;
    }

    public function get_allow_multiple() {
        return $this->multiple;
    }

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
}