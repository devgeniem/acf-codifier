<?php
namespace Geniem\ACF;

class Group {
    protected $title;

    protected $key;

    protected $menu_order;

    protected $position;

    protected $style;

    protected $label_placement;

    protected $instruction_placement;

    protected $hide_on_screen;

    protected $location;

    protected $fields;

    protected $active;

    protected $registered = false;

    public function __construct( string $title ) {
        $this->title = $title;

        $this->key = sanitize_title( $title );

        $this->active = 1;
    }

    private function __clone() {}

    public function clone( $key, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->reset();

        return $clone;
    }

    public function export() {
        $obj = get_object_vars( $this );

        if ( ! empty( $obj['fields'] ) ) {
            $obj['fields'] = array_map( function( $field ) {
                return $field->export();
            }, $obj['fields'] );

            $obj['fields'] = array_values( $obj['fields'] );
        }

        return $obj;
    }

    public function set_title( string $title ) {
        $this->title = $title;

        return $this;
    }

    public function get_title() {
        return $this->title;
    }

    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    public function get_key() {
        return $this->key;
    }

    public function set_menu_order( int $order = 0 ) {
        $this->menu_order = $order;

        return $this;
    }

    public function get_menu_order() {
        return $this->menu_order;
    }

    public function set_position( string $position = 'normal' ) {
        if ( ! in_array( $position, [ 'acf_after_title', 'normal', 'side' ] ) ) {
            throw new Exception ( 'Geniem\ACF\Group: set_position() does not accept argument "' . $position .'"' );
        }

        $this->position = $position;

        return $this;
    }

    public function get_position() {
        return $this->position;
    }

    public function set_style( string $style = 'default' ) {
        if ( ! in_array( $style, [ 'default', 'seamless' ] ) ) {
            throw new Exception ( 'Geniem\ACF\Group: set_style() does not accept argument "' . $style .'"' );
        }

        $this->style = $style;

        return $this;
    }

    public function get_style() {
        return $this->style;
    }

    public function set_label_placement( string $placement = 'top' ) {
        if ( ! in_array( $placement, [ 'top', 'left' ] ) ) {
            throw new Exception ( 'Geniem\ACF\Group: set_label_placement() does not accept argument "' . $placement .'"' );
        }

        $this->label_placement = $placement;

        return $this;
    }

    public function get_label_placement() {
        return $this->label_placement;
    }

    public function set_instruction_placement( string $placement = 'label' ) {
        if ( ! in_array( $placement, [ 'label', 'field' ] ) ) {
            throw new Exception ( 'Geniem\ACF\Group: set_instruction_placement() does not accept argument "' . $placement .'"' );
        }

        $this->instruction_placement = $placement;

        return $this;
    }

    public function set_hidden_elements( array $elements ) {
        $this->hide_on_screen = $elements;

        return $this;
    }

    public function get_hidden_elements() {
        return $this->hide_on_screen;
    }

    public function hide_element( string $element ) {
        $this->hide_on_screen[] = $element;

        $this->hide_on_screen = array_unique( $this->hide_on_screen );

        return $this;
    }

    public function show_element( string $element ) {
        $position = array_search( $element, $this->hide_on_screen );

        if ( ( $position !== false ) ) {
            unset( $this->hide_on_screen[ $position ] );
        }

        return $this;
    }

    public function add_rule_group( \Geniem\ACF\RuleGroup $group ) {
        $rules = $group->get_rules();

        if ( count( $rules ) > 0 ) {
            $this->location[] = $rules;
        }

        return $this;
    }

    public function get_rule_groups() {
        return $this->location;
    }

    public function add_field( $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new Exception( 'Geniem\ACF\Group: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
        }

        if ( $field instanceof \ Geniem\ACF\Field\Tab ) {
            $sub_fields = $field->get_fields();

            $field->remove_fields();
        }

        $this->fields[ $field->get_name() ] = $field;

        if ( $this->registered ) {
            if ( function_exists( 'acf_add_local_field' ) ) {
                $exported = $field->export();

                $exported['parent'] = $this->key;

                \acf_add_local_field( $exported );
            }
        }

        if ( ! empty( $sub_fields ) ) {
            foreach ( $sub_fields as $sub_field ) {
                $this->add_field( $sub_field );
            }
        }

        return $this;
    }

    public function remove_field( $name ) {
        if ( $this->registered ) {
            if ( function_exists( 'acf_add_local_field' ) ) {
                $field = $field->export();

                $field['parent'] = $this->key;

                \acf_add_local_field( $field );
            }
        }

        if ( isset( $this->fields[ $name ] ) ) {
            unset( $this->fields[ $name ] );
        }

        return $this;
    }

    public function get_field( $name ) {
        return $this->fields[ $name ];
    }

    public function get_fields() {
        return $this->fields;
    }

    public function activate() {
        $this->active = 1;

        return $this;
    }

    public function deactivate() {
        $this->active = 0;

        return $this;
    }

    public function register() {
        if ( function_exists( 'acf_add_local_field_group' ) ) {
            \acf_add_local_field_group( $this->export() );

            $this->registered = true;
        }
    }

    public function reset() {
        $this->registered = false;
    }
}