<?php
namespace Geniem\ACF\Field;

class Taxonomy extends \Geniem\ACF\Field {
    protected $type = 'taxonomy';

    protected $taxonomy;

    protected $field_type;

    protected $allow_null;

    protected $load_save_terms;

    protected $add_term;

    public function set_taxonomy( string $taxonomy = 'category' ) {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    public function get_taxonomy() {
        return $this->taxonomy;
    }

    public function set_field_type( string $field_type = 'checkbox' ) {
        if ( ! in_array( $field_type, [ 'checkbox', 'multi_select', 'radio', 'select' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_field_type() does not accept argument "' . $field_type .'"' );
        }

        $this->field_type = $field_type;

        return $this;
    }

    public function get_field_type() {
        return $this->field_type;
    }

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

    public function allow_load_save_terms() {
        $this->load_save_terms = 1;

        return $this;
    }

    public function disallow_load_save_terms() {
        $this->load_save_terms = 0;

        return $this;
    }

    public function get_load_save_terms() {
        return $this->load_save_terms;
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

    public function allow_add_term() {
        $this->add_term = 1;

        return $this;
    }

    public function disallow_add_term() {
        $this->add_term = 0;

        return $this;
    }

    public function get_add_term() {
        return $this->add_term;
    }
}
