<?php
namespace Geniem\ACF\Field;

class FlexibleContent extends \Geniem\ACF\Field {
    protected $type = 'flexible_content';

    protected $button_label;

    protected $min;

    protected $max;

    protected $layouts;

    public function __construct( $label ) {
        $this->button_label = __( 'Add Row', 'acf' );

        parent::__construct( $label );
    }

    public function export() {
        $obj = parent::export();

        if ( ! empty( $obj['layouts'] ) ) {
            $obj['layouts'] = array_map( function( $layout ) {
                return $layout->export();
            }, $obj['layouts'] );

            $obj['layouts'] = array_values( $obj['layouts'] );
        }

        return $obj;
    }

    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    public function get_max() {
        return $this->max;
    }

    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    public function get_min() {
        return $this->min;
    }

    public function add_layout( $layout ) {
        if ( ! ( $layout instanceof \Geniem\ACF\Flexible\Layout ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\FlexibleContent: add_layout() requires an argument that is a string or type "\Geniem\ACF\Flexible\Layout"' );
        }

        $name = $layout->get_name();

        $this->layouts[ $name ] = $layout;

        $this->layouts = array_unique( $this->layouts );

        return $this;
    }

    public function remove_layout( $layout ) {
        if ( ! ( $layout instanceof \Geniem\ACF\Flexible\Layout || is_string( $layout ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\FlexibleContent: remove_layout() requires an argument that is a string or type "\Geniem\ACF\Flexible\Layout"' );
        }

        if ( is_string( $layout ) ) {
            $name = $layout;
        }
        else {
            $name = $layout->get_name();
        }

        unset( $this->layouts[ $name ] );

        return $this;
    }

    public function get_layout( $layout ) {
        return $this->layouts[ $layout ];
    }

    public function get_layouts() {
        return $this->layouts;
    }
}
