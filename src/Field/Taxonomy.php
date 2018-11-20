<?php
/**
 * Acf codifier taxonomy field
 */

namespace Geniem\ACF\Field;

/**
 * Class Taxonomy
 */
class Taxonomy extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'taxonomy';

    /**
     * What taxonomy to use
     *
     * @var string
     */
    protected $taxonomy;

    /**
     * How the field is displayed
     *
     * @var string
     */
    protected $field_type;

    /**
     * Should an empty value be allowed
     *
     * @var integer
     */
    protected $allow_null;

    /**
     * Should terms be saved to the post or just meta data
     *
     * @var integer
     */
    protected $save_terms;

    /**
     * Should terms be loaded from the post or just meta data
     *
     * @var integer
     */
    protected $load_terms;

    /**
     * Should user be able to add terms using this
     *
     * @var integer
     */
    protected $add_term;

    /**
     * Set taxonomy
     *
     * @param string $taxonomy Taxonomy slug.
     * @return self
     */
    public function set_taxonomy( string $taxonomy = 'category' ) {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * Get taxonomy
     *
     * @return string
     */
    public function get_taxonomy() {
        return $this->taxonomy;
    }

    /**
     * Set displayed field type
     *
     * @throws \Geniem\ACF\Exception Info if field_type is not valid.
     * @param string $field_type New field type.
     * @return self
     */
    public function set_field_type( string $field_type = 'checkbox' ) {
        if ( ! in_array( $field_type, [ 'checkbox', 'multi_select', 'radio', 'select' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_field_type() does not accept argument "' . $field_type . '"' );
        }

        $this->field_type = $field_type;

        return $this;
    }

    /**
     * Get displayed field type
     *
     * @return string
     */
    public function get_field_type() {
        return $this->field_type;
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
     * Enable saving terms to the post object
     *
     * @return self
     */
    public function allow_save_terms() {
        $this->save_terms = 1;

        return $this;
    }

    /**
     * Disable saving terms to the post object
     *
     * @return self
     */
    public function disallow_save_terms() {
        $this->save_terms = 0;

        return $this;
    }

    /**
     * Get the status of saving terms to the post object
     *
     * @return integer
     */
    public function get_save_terms() {
        return $this->save_terms;
    }

    /**
     * Enable loading terms to the post object
     *
     * @return self
     */
    public function allow_load_terms() {
        $this->load_terms = 1;

        return $this;
    }

    /**
     * Disable loading terms to the post object
     *
     * @return self
     */
    public function disallow_load_terms() {
        $this->load_terms = 0;

        return $this;
    }

    /**
     * Get the status of loading terms to the post object
     *
     * @return integer
     */
    public function get_load_terms() {
        return $this->load_terms;
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
     * Enable adding terms
     *
     * @return self
     */
    public function allow_add_term() {
        $this->add_term = 1;

        return $this;
    }

    /**
     * Disable adding terms
     *
     * @return self
     */
    public function disallow_add_term() {
        $this->add_term = 0;

        return $this;
    }

    /**
     * Get whether terms can be added
     *
     * @return integer
     */
    public function get_add_term() {
        return $this->add_term;
    }

    /**
     * Register a arguments filtering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function filter_arguments( callable $function ) {
        if ( in_array( $this->field_type, [ 'radio', 'checkbox' ], true ) ) {
            $this->filters['filter_arguments'] = [
                'filter'        => 'acf/fields/taxonomy/wp_list_categories/key=',
                'function'      => $function,
                'priority'      => 10,
                'accepted_args' => 2,
            ];
        }
        else if ( $this->field_type === 'select' ) {
            $this->filters['filter_arguments'] = [
                'filter'        => 'acf/fields/taxonomy/query/key=',
                'function'      => $function,
                'priority'      => 10,
                'accepted_args' => 3,
            ];
        }

        return $this;
    }
}
