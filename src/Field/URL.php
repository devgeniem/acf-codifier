<?php
/**
 * Acf codifier url field
 */

namespace Geniem\ACF\Field;

/**
 * Class URL
 */
class URL extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'url';

    /**
     * Field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * Set placeholder value
     *
     * @param string $placeholder Placeholder.
     * @return self
     */
    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get placeholder value
     *
     * @return string
     */
    public function get_placeholder() {
        return $this->placeholder;
    }
}
