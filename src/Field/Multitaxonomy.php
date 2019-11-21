<?php
/**
 * ACF Codifier field for creating a multitaxonomy field.
 */

namespace Geniem\ACF\Field;

/**
 * Class Taxonomy
 */
class Multitaxonomy extends Taxonomy {

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'multitaxonomy';

    /**
     * Which taxonomies to use.
     *
     * @var array
     */
    protected $taxonomies;

    /**
     * Get taxonomies.
     *
     * @return array
     */
    public function get_taxonomies() : ?array {
        return $this->taxonomies;
    }

    /**
     * You should not use this method! Overridden method of the parent class.
     *
     * Use get_taxonomies() instead.
     *
     * @return string|null
     */
    public function get_taxonomy() : ?string {
        return $this->taxonomies[0] ?? null;
    }

    /**
     * You should not use this method! Overridden method of the parent class.
     *
     * Use set_taxonomies() instead.
     *
     * @param string $taxonomy Taxonomy slug.
     * @return self
     */
    public function set_taxonomy( string $taxonomy = 'category' ) {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * Set taxonomies.
     *
     * @param array $taxonomy An array of taxonomy slugs.
     * @return self
     */
    public function set_taxonomies( array $taxonomy = [ 'category' ] ) {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * Override the parent method to disallow adding terms.
     *
     * @return self
     */
    public function allow_add_term() {
        $this->add_term = 0;

        return $this;
    }

    /**
     * Override the parent method to disallow adding terms.
     *
     * @return integer
     */
    public function get_add_term() {
        return false;
    }

}

