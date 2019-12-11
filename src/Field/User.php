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
     * Return format to set
     *
     * @var string
     */
    protected $return_format;

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
        global $wp_roles;

        // Populate the role array with all roles to remove just one if it's empty
        if ( empty( $this->role ) ) {
            $this->role = array_keys( $wp_roles->get_names() );
        }

        $position = array_search( $role, $this->role, true );

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
        global $wp_roles;

        // Show all roles if the role array is empty
        if ( empty( $this->role ) ) {
            return array_keys( $wp_roles->get_names() );
        }

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

    /**
     * Register a user query filtering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function user_query( callable $function ) {
        $this->filters['user_query'] = [
            'filter'        => 'acf/fields/user/query/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 3,
        ];

        return $this;
    }

    /**
     * Set return format
     *
     * @throws \Geniem\ACF\Exception Throws error if $return_format is not valid.
     * @param string $return_format Return format to use.
     * @return self
     */
    public function set_return_format( string $return_format = 'object' ) {
        if ( ! in_array( $return_format, [ 'array', 'object', 'id' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\User: set_return_format() does not accept argument "' . $return_format . '"' );
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
}
