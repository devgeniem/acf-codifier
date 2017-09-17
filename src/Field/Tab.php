<?php
namespace Geniem\ACF\Field;

class Tab extends \Geniem\ACF\Field {
    protected $type = 'tab';

    protected $sub_fields;

    protected $placement = 'top';

    protected $endpoint = 0;

    public function set_layout( string $layout = 'table' ) {
        if ( ! in_array( $layout, [ 'table', 'block', 'row' ] ) ) {
            throw new Exception ('Geniem\ACF\Field\Tab: set_layout() does not accept argument "' . $layout .'"' );
        }

        $this->layout = $layout;

        return $this;
    }

    public function get_layout() {
        return $this->layout;
    }

    public function add_field( $field ) {
        if ( ! $field instanceof \Geniem\ACF\Field ) {
            throw new Exception ('Geniem\ACF\Field\Tab: add_field() requires an argument that is type "\Geniem\ACF\Field"' );
        }

        $this->sub_fields[] = $field;

        return $this;
    }

    public function remove_field( $field ) {
        unset( $this->sub_fields[ $field ] );

        return $this;
    }

    public function get_fields() {
        return $this->sub_fields;
    }

    public function remove_fields() {
        unset( $this->sub_fields );

        return $this;
    }

    public function set_placement( string $placement = 'top' ) {
        if ( ! in_array( $placement, [ 'top', 'left' ] ) ) {
            throw new Exception ('Geniem\ACF\Field\Tab: set_placement() does not accept argument "' . $placement .'"' );
        }

        $this->placement = $placement;

        return $this;
    }

    public function get_placement() {
        return $this->placement;
    }

    public function set_endpoint() {
        $this->endpoint = 1;

        return $this;
    }

    public function remove_endpoint() {
        $this->endpoint = 0;

        return $this;
    }

    public function get_endpoint() {
        return $this->endpoint;
    }
}
