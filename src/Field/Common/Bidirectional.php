<?php
/**
 * ACF Codifier bidirectional trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Bidirectional trait
 */
trait Bidirectional {
    /**
     * Field bidirectional status.
     *
     * @var boolean
     */
    protected $bidirectional = 0;

    /**
     * Bidirectional targets.
     *
     * @var array
     */
    protected $bidirectional_target = [];

    /**
     * Set bidirectional.
     *
     * @return self
     */
    public function set_bidirectional() {
        $this->bidirectional = 1;

        return $this;
    }

    /**
     * Set unidirectional (disable bidirectional).
     *
     * @return self
     */
    public function set_unidirectional() {
        $this->bidirectional = 0;

        return $this;
    }

    /**
     * Get bidirectional status.
     *
     * @return boolean
     */
    public function get_bidirectional() {
        return $this->bidirectional;
    }

    /**
     * Set bidirectional targets.
     *
     * @param array $targets Target field names or keys.
     * @return self
     */
    public function set_bidirectional_targets( array $targets = [] ) {
        $this->bidirectional_target = $targets;

        return $this;
    }

    /**
     * Add bidirectional target.
     *
     * @param string $target Target field name or key.
     * @return self
     */
    public function add_bidirectional_target( string $target ) {
        $this->bidirectional_target[] = $target;

        return $this;
    }

    /**
     * Remove bidirectional target.
     *
     * @param string $target Target field name or key.
     * @return self
     */
    public function remove_bidirectional_target( string $target ) {
        $key = array_search( $target, $this->bidirectional_target );

        if ( $key !== false ) {
            unset( $this->bidirectional_target[ $key ] );
        }

        return $this;
    }

    /**
     * Get bidirectional targets.
     *
     * @return array
     */
    public function get_bidirectional_targets() {
        return $this->bidirectional_target;
    }
}
