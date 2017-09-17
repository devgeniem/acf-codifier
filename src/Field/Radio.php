<?php
namespace Geniem\ACF\Field;

class Radio extends Field {
    protected $type = 'radio';

    protected $choices;

    protected $other_choice;

    protected $checkbox;

    public function set_choices( $choices ) {
        if ( ! is_array( $choices ) ) {
            throw new Exception ('Geniem\ACF\Group: set_choices() requires an array as an argument' );
        }

        $this->choices = $choices;

        return $this;
    }

    public function add_choice( $choice ) {
        if ( is_array( $choice ) ) {
            if ( count( $choice ) > 0 ) {
                throw new Exception ('Geniem\ACF\Group: add_choice() requires an array with exactly one value as an argument' );
            }

            $this->choices = array_merge( $this->choices, $choice );
        }
        else {
            $this->choices[] = $choice;
        }

        return $this;
    }

    public function remove_choice( $choice ) {
        if ( is_array( $choice ) ) {
            if ( count( $choice ) > 0 ) {
                throw new Exception ('Geniem\ACF\Group: add_choice() requires an array with exactly one value as an argument' );
            }

            if ( isset( $this->choices[ $choice[0] ] ) && $this->choices[ $choice[ 0 ] ] === $choice[ 1 ] ) {
                unset( $this->choices[ $choice[0] ] );
            }
        }
        else {
            $position = array_search( $choice, $this->choices );

            if ( ( $position !== false ) ) {
                unset( $this->choices[ $position ] );
            }
        }

        return $this;
    }

    public function get_choices() {
        return $this->choices;
    }

    public function allow_other_choice() {
        $this->other_choice = 1;

        return $this;
    }

    public function disallow_other_choice() {
        $this->other_choice = 0;

        return $this;
    }

    public function get_other_choice() {
        return $this->other_choice;
    }

    public function set_layout( string $layout = 'vertical' ) {
        if ( ! in_array( $layout, [ 'vertical', 'horizontal' ] ) ) {
            throw new Exception ('Geniem\ACF\Group: set_layout() does not accept argument "' . $layout .'"' );
        }

        $this->layout = $layout;

        return $this;
    }

    public function get_layout() {
        return $this->layout;
    }
}