<?php
/**
 * Acf codifier flexible content class
 */

namespace Geniem\ACF\Field;

/**
 * Class FlexibleContent
 */
class FlexibleContent extends \Geniem\ACF\Field {

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'flexible_content';

    /**
     * Button label
     *
     * @var string
     */
    protected $button_label;

    /**
     * Minimum amount of flexible layouts to add
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum amount of flexible layouts to add
     *
     * @var integer
     */
    protected $max;

    /**
     * Layouts added
     *
     * @var array
     */
    protected $layouts = [];

    /**
     * Exclude layouts from post types
     *
     * @var array
     */
    protected $exclude_post_types = [];

    /**
     * Exclude layouts from templates
     *
     * @var array
     */
    protected $exclude_templates = [];

    /**
     * Exclude layouts from fields
     *
     * @var array
     */
    protected $exclude_fields = [];

    /**
     * Override field construction method to add default button label but run parent constructor after that
     *
     * @param string $label Field label.
     * @param string $key   Field key.
     * @param string $name  Field name.
     */
    public function __construct( $label, $key = null, $name = null ) {
        $this->button_label = __( 'Add Row', 'acf' );

        parent::__construct( $label, $key, $name );
    }

    /**
     * Export field in ACF's native format.
     * This also exports layout fields
     *
     * @param boolean $register Whether the field is to be registered.
     *
     * @throws Exception Throws an exception if a key or a name is not defined.
     *
     * @return array
     */
    public function export( bool $register = false ) {
        global $post;

        if ( empty( $this->key ) ) {
            throw new Exception( 'Field ' . $this->label . ' does not have a key defined.' );
        }

        if ( empty( $this->name ) ) {
            throw new Exception( 'Field ' . $this->label . ' does not have a name defined.' );
        }

        if ( ! empty( $this->layouts ) ) {
            $this->layouts = array_map( function( $layout ) use ( $register, $post ) {
                if ( $register && $layout instanceof Flexible\Layout ) {
                    $exclude_post_types = $layout->get_excluded_post_types();
                    $exclude_templates  = $layout->get_excluded_templates();
                    $exclude_fields     = $layout->get_excluded_fields();

                    if ( ! empty( $exclude_post_types ) ) {
                        foreach ( $exclude_post_types as $exclude ) {
                            if ( ! isset( $this->exclude_post_types[ $exclude ] ) ) {
                                $this->exclude_post_types[ $exclude ] = [];
                            }

                            $this->exclude_post_types[ $exclude ][] = $layout->get_name();
                        }
                    }

                    if ( ! empty( $exclude_templates ) ) {
                        foreach ( $exclude_templates as $exclude ) {
                            if ( ! isset( $this->exclude_templates[ $exclude ] ) ) {
                                $this->exclude_templates[ $exclude ] = [];
                            }

                            $this->exclude_templates[ $exclude ][] = $layout->get_key();
                        }
                    }

                    if ( ! empty( $exclude_fields ) ) {
                        foreach ( $exclude_fields as $exclude ) {
                            if ( ! isset( $this->exclude_fields[ $exclude ] ) ) {
                                $this->exclude_fields[ $exclude ] = [];
                            }

                            $this->exclude_fields[ $exclude ][] = $layout->get_name();
                        }
                    }
                }

                if ( $layout instanceof Flexible\Layout ) {
                    return $layout->export( $register );
                }
                else {
                    return $layout;
                }
            }, $this->layouts );

            $this->exclude_post_types();
            $this->exclude_templates();
            $this->exclude_fields();

            $this->layouts = array_values( $this->layouts );
        }

        $obj = parent::export( $register );

        // Remove post type exclude info
        unset( $obj['exclude_post_types'] );

        return $obj;
    }

    /**
     * Set add row button label
     *
     * @param string $button_label Text to show inside button.
     * @return self
     */
    public function set_button_label( string $button_label ) {
        $this->button_label = $button_label;

        return $this;
    }

    /**
     * Get button label
     *
     * @return string Button label
     */
    public function get_button_label() {
        return $this->button_label;
    }

    /**
     * Set maximum amount of layouts
     *
     * @param integer $max Maximum amount.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum amount of layouts
     *
     * @return integer Maximum amount
     */
    public function get_max() {
        return $this->max;
    }

    /**
     * Set minimum amount of layouts
     *
     * @param integer $min Minimum amount.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum amount of layouts
     *
     * @return integer Minimum amount
     */
    public function get_min() {
        return $this->min;
    }

    /**
     * Add a layout to the layouts
     *
     * @throws \Geniem\ACF\Exception Throws error if $layout is not valid.
     * @param \Geniem\ACF\Field\Flexible\Layout $layout Layout to add.
     * @return self
     */
    public function add_layout( \Geniem\ACF\Field\Flexible\Layout $layout ) {
        if ( ! ( $layout instanceof \Geniem\ACF\Field\Flexible\Layout ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\FlexibleContent: add_layout() requires an argument that is of type "\Geniem\ACF\Flexible\Layout"' );
        }

        $name = $layout->get_name();

        $this->layouts[ $name ] = $layout;

        return $this;
    }

    /**
     * Remove layout from layouts
     *
     * @throws \Geniem\ACF\Exception Throws error if $layout is not valid.
     * @param  \Geniem\ACF\Field\Flexible\Layout|string $layout Either a layout class or layout name.
     * @return self
     */
    public function remove_layout( $layout ) {
        if ( ! ( $layout instanceof \Geniem\ACF\Field\Flexible\Layout || is_string( $layout ) ) ) {
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

    /**
     * Get layout by name
     *
     * @param  string $layout Layout name.
     * @return \Geniem\ACF\Field\Flexible\Layout
     */
    public function get_layout( string $layout ) {
        return $this->layouts[ $layout ];
    }

    /**
     * Get all layouts
     *
     * @return array
     */
    public function get_layouts() {
        return $this->layouts;
    }

    /**
     * Set layouts
     *
     * @param array $layouts The layouts to set.
     * @return self
     */
    public function set_layouts( array $layouts ) {
        foreach ( $layouts as $layout ) {
            if ( $layout instanceof Flexible\Layout ) {
                $this->layouts[ $layout->get_name() ] = $layout;
            }
            else {
                $this->layouts[ $layout['name'] ] = $layout;
            }
        }

        return $this;
    }

    /**
     * Exclude from post types
     *
     * @return void
     */
    protected function exclude_post_types() {
        global $post;

        if ( ! empty( $this->exclude_post_types ) ) {
            $post_types = $this->exclude_post_types;

            add_filter( 'acf/load_field/key=' . $this->key, function( $field ) use ( $post_types ) {
                global $post;

                if ( ! empty( $post_types[ $post->post_type ] ) ) {
                    $field['layouts'] = array_filter( $field['layouts'], function( $layout ) use ( $post_types, $post ) {
                        return array_search( $layout['name'], $post_types[ $post->post_type ], true ) === false;
                    });
                }

                return $field;
            });
        }
    }

    /**
     * Exclude from templates
     *
     * @return void
     */
    protected function exclude_templates() {
        // If the template was changed via AJAX
        $template = filter_input( INPUT_POST, 'page_template' );

        // ...or if this is an already known page with selected template.
        if ( ! $template ) {
            $post_id = filter_input( INPUT_GET, 'post' );

            $template = get_post_meta( $post_id, '_wp_page_template', true );
        }

        if ( $template ) {
            $excludes = $this->exclude_templates[ $template ] ?? [];

            if ( ! empty( $excludes ) ) {
                add_filter( 'acf/get_fields', function( $fields ) use ( $excludes ) {
                    $params = array_fill( 0, count( $fields ), $excludes );
                    $fields = array_map( [ $this, 'handle_field' ], $fields, $params );

                    return $fields;
                });
            }
        }
    }

    /**
     * Handle a field in template excluding
     *
     * @param array $field    The field to process.
     * @param array $excludes An array of templates to exclude.
     * @return array
     */
    private function handle_field( $field, $excludes ) {
        if ( $field['type'] === 'flexible_content' ) {
            $field['layouts'] = $this->handle_layouts( $field['layouts'], $excludes );
        }
        elseif ( isset( $field['sub_fields'] ) ) {
            $params              = array_fill( 0, count( $field['sub_fields'] ), $excludes );
            $field['sub_fields'] = array_map( [ $this, 'handle_field' ], $field['sub_fields'], $params );
        }

        return $field;
    }

    /**
     * Handle an array of layouts in template excluding
     *
     * @param array $layouts  An array of layouts to process.
     * @param array $excludes An array of templates to exclude.
     * @return array
     */
    private function handle_layouts( $layouts, $excludes ) {
        $layouts = array_filter( $layouts, function( $layout ) use ( $excludes ) {
            if ( in_array( $layout['key'], $excludes, true ) ) {
                return false;
            }
            else {
                return true;
            }
        });

        return $layouts;
    }

    /**
     * Exclude from fields
     *
     * @return void
     */
    protected function exclude_fields() {
        if ( ! empty( $this->exclude_fields ) ) {
            $layouts = $this->exclude_fields[ $this->get_name() ] ?? [];

            if ( ! empty( $layouts ) ) {
                add_filter( 'acf/load_field/key=' . $this->key, function( $field ) use ( $layouts ) {
                    $field['layouts'] = array_filter( $field['layouts'], function( $layout ) use ( $layouts ) {
                        return array_search( $layout['name'], $layouts, true ) === false;
                    });

                    return $field;
                });
            }
        }
    }
}
