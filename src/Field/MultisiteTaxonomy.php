<?php
/**
 * ACF Codifier field for creating a multisite taxonomy field.
 */

namespace Geniem\ACF\Field;

/**
 * Class Taxonomy
 */
class MultisiteTaxonomy extends Multitaxonomy {

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'multisite_taxonomy';

    /**
     * Blog ID.
     *
     * @var integer
     */
    protected $blog_id = null;

    /**
     * Set blog id
     *
     * @param integer $blog_id Blog ID to set.
     * @return self
     */
    public function set_blog_id( int $blog_id ) {
        $this->blog_id = $blog_id;

        return $this;
    }

    /**
     * Get blog id
     *
     * @return integer Blog ID.
     */
    public function get_blog_id() {
        return $this->blog_id;
    }

    /**
     * Not in use. Only here because of the parent class.
     *
     * @throws \Exception This method is not in use.
     * @return self
     */
    public function allow_save_terms() {
        throw new \Exception( 'This method does not work with MultisiteTaxonomy fields.' );

        return $this; // phpcs:ignore
    }

    /**
     * Not in use. Only here because of the parent class.
     *
     * @throws \Exception This method is not in use.
     * @return self
     */
    public function disallow_save_terms() {
        throw new \Exception( 'This method does not work with MultisiteTaxonomy fields.' );

        return $this; // phpcs:ignore
    }
}

