<?php
/**
 * ACF Codifier field for creating a multitaxonomy field.
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\Disabled;

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
    protected $taxonomy = [];
    /**
     * Get taxonomies.
     *
     * @return array
     */
    public function get_taxonomies() : ?array {
        return $this->taxonomy;
    }

    /**
     * You should not use this method! Overridden method of the parent class.
     *
     * Use get_taxonomies() instead.
     *
     * @throws \Exception This method is not in use.
     * @return string|null
     */
    public function get_taxonomy() : ?string {
        throw new \Exception( 'This method does not work with MultiTaxonomy fields.' );

        return ''; // phpcs:ignore
    }

    /**
     * You should not use this method! Overridden method of the parent class.
     *
     * Use set_taxonomies() or add_taxonomy() instead.
     *
     * @param string $taxonomy Not in use.
     *
     * @throws \Exception This method is not in use.
     * @return self
     */
    public function set_taxonomy( string $taxonomy = 'category' ) {
        throw new \Exception( 'This method does not work with MultiTaxonomy fields.' );

        return $this; // phpcs:ignore
    }

    /**
     * You should not use this method! Overridden method of the parent class.
     *
     * Use set_taxonomies() instead.
     *
     * @param string $taxonomy Taxonomy slug.
     * @return self
     */
    public function add_taxonomy( string $taxonomy = 'category' ) {
        $this->taxonomy[] = $taxonomy;

        $this->taxonomy = array_unique( $this->taxonomy );

        return $this;
    }

    /**
     * Remove a taxonomy from the list.
     *
     * @param string $taxonomy The taxonomy to remove.
     * @return self
     */
    public function remove_taxonomy( string $taxonomy ) {
        $position = array_search( $taxonomy, $this->taxonomy );

        if ( ( $position !== false ) ) {
            unset( $this->taxonomy[ $position ] );
        }

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

