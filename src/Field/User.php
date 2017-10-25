<?php
/**
 * Acf codifier user field
 */

namespace Geniem\ACF\Field;

/**
 * Class User
 */
class User extends \Geniem\ACF\Field {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'user';

    /**
     * What roles to show
     *
     * @var array
     */
    protected $role;

    /**
     * Should an empty value be allowed
     *
     * @var integer
     */
    protected $allow_null;

    /**
     * Should multiple values be allowed
     *
     * @var integer
     */
    protected $multiple;

    /**
     * Set allowed roles
     *
     * @throws \Geniem\ACF\Exception Throws error if roles is not valid.
     * @param array $roles Allowed roles.
     * @return self
     */
    public function set_roles( array $roles ) {
        if ( ! is_array( $roles ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Group: set_roles() requires an array as an argument' );
        }

        $this->role = $roles;

        return $this;
    }

    /**
     * Add a single role to allowed roles
     *
     * @param string $role Role slug.
     * @return self
     */
    public function add_role( string $role ) {
        $this->role[] = $role;

        $this->role = array_unique( $this->role );

        return $this;
    }

    /**
     * Remove role from allowed roles
     *
     * @param  string $role Role slug.
     * @return self
     */
    public function remove_role( $role ) {
        $position = array_search( $role, $this->role );

        if ( ( $position !== false ) ) {
            unset( $this->role[ $position ] );
        }

        return $this;
    }

    /**
     * Get allowed roles
     *
     * @return array
     */
    public function get_roles() {
        return $this->role;
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
     * Allow multiple values
     *
     * @return self
     */
    public function allow_multiple() {
        $this->multiple = 1;

        return $this;
    }

    /**
     * Disallow multiple values
     *
     * @return self
     */
    public function disallow_multiple() {
        $this->multiple = 0;

        return $this;
    }

    /**
     * Get allow multiple status
     *
     * @return integer
     */
    public function get_allow_multiple() {
        return $this->multiple;
    }
}
