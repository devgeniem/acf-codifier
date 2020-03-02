<?php
/**
 * ACF codifier multisite post object field
 */

namespace Geniem\ACF\Field;

/**
 * Class MultisitePostObject
 */
class MultisitePostObject extends PostObject {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'multisite_post_object';

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
}
