<?php
/**
 * Acf codifier pagelink field
 */

namespace Geniem\ACF\Field;

/**
 * Class PageLink
 */
class PageLink extends PostObject {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'page_link';

    /**
     * Should archive links be allowed
     *
     * @var integer
     */
    protected $allow_archives;

    /**
     * Allow archive links
     *
     * @return self
     */
    public function allow_archives() {
        $this->allow_archives = 1;

        return $this;
    }

    /**
     * Disallow archive links
     *
     * @return self
     */
    public function disallow_archives() {
        $this->allow_archives = 0;

        return $this;
    }

    /**
     * Get whether archives should be allowed or not
     *
     * @return integer
     */
    public function get_allow_archives() {
        return $this->allow_archives;
    }
}
