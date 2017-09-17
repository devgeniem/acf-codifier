<?php
namespace Geniem\ACF\Field;

class Select extends Field {
    protected $type = 'select';

    protected $choices;

    protected $allow_null;

    protected $multiple;

    protected $ui;

    protected $ajax;
    
    protected $placeholder;

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

    public function use_ui() {
        $this->ui = 1;

        return $this;
    }

    public function no_ui() {
        $this->ui = 0;

        return $this;
    }

    public function ui() {
        return $this->ui;
    }

    public function use_ajax() {
        $this->ajax = 1;

        return $this;
    }

    public function no_ajax() {
        $this->ajax = 0;

        return $this;
    }

    public function get_ajax() {
        return $this->ajax;
    }

    public function set_placeholder( string $placeholder ) {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function get_placeholder() {
        return $this->placeholder;
    }
}