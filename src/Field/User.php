<?php
namespace Geniem\ACF\Field;

class User extends Field {
    protected $type = 'user';

    protected $role;

    protected $allow_null;

    protected $multiple;

    public function set_roles( $roles ) {
        if ( ! is_array( $roles ) ) {
            throw new Exception ('Geniem\ACF\Group: set_roles() requires an array as an argument' );
        }

        $this->role = $roles;

        return $this;
    }

    public function add_role( $role ) {
        $this->role[] = $role;

        $this->role = array_unique( $this->role );

        return $this;
    }

    public function remove_role( $role ) {
        $position = array_search( $role, $this->role );

        if ( ( $position !== false ) ) {
            unset( $this->role[ $position ] );
        }

        return $this;
    }

    public function get_roles() {
        return $this->role;
    }

    public function allow_null() {
        $this->allow_null = 1;

        return $this;
    }

    public function disallow_null() {
        $this->allow_null = 0;

        return $this;
    }

    public function get_allow_null() {
        return $this->allow_null;
    }

    public function allow_multiple() {
        $this->multiple = 1;

        return $this;
    }

    public function disallow_multiple() {
        $this->multiple = 0;

        return $this;
    }

    public function get_allow_multiple() {
        return $this->multiple;
    }
}