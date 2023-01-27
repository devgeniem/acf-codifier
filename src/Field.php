<?php
/**
 * ACF Codifier Field class
 */

namespace Geniem\ACF;

/**
 * Class Field
 */
abstract class Field {
    /**
     * Field label.
     *
     * @var string
     */
    protected $label;

    /**
     * Field key.
     *
     * @var string
     */
    protected $key;

    /**
     * Field name.
     *
     * @var string
     */
    protected $name;

    /**
     * Field instructions.
     *
     * @var string
     */
    protected $instructions;

    /**
     * Field required status.
     *
     * @var boolean
     */
    protected $required = 0;

    /**
     * Conditional logic attached to the field.
     *
     * @var array
     */
    protected $conditional_logic = [];

    /**
     * Default value for the field.
     *
     * @var mixed
     */
    protected $default_value;

    /**
     * Filters and actions to be hooked.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Whether to hide the label or not
     *
     * @var boolean
     */
    protected $hide_label = false;

    /**
     * Default filter arguments
     *
     * @var array
     */
    protected $default_filter_arguments = [];

    /**
     * Whether the field should be included in RediPress search index or not.
     *
     * @var boolean
     */
    protected $redipress_include_search = false;

    /**
     * The callback that should be run when indexing the field.
     *
     * @var callable
     */
    protected $redipress_include_search_callback = null;

    /**
     * Whether the field is queryable in RediPress or not.
     *
     * @var boolean
     */
    protected $redipress_add_queryable = false;

    /**
     * With what name should the field be indexed into RediSearch.
     *
     * @var string
     */
    protected $redipress_add_queryable_field_name;

    /**
     * With what weight should a text field be indexed into RediSearch.
     *
     * @var float
     */
    protected $redipress_add_queryable_field_weight;

    /**
     * The method with which the data is saved into RediSearch.
     *
     * @var string|callable
     */
    protected $redipress_add_queryable_method;

    /**
     * A possible filter method for the value before inserting to RediSearch.
     *
     * @var callable
     */
    protected $redipress_queryable_filter;

    /**
     * What type the RediPress index field should be. Defaults to 'Text'.
     *
     * @var string
     */
    protected $redipress_field_type = 'Text';

    /**
     * Store registered field keys to warn if there are duplicates.
     *
     * @var array
     */
    static protected $keys = [];

    /**
     * A static variable to store if we are indexing for Redipress or not.
     *
     * @var boolean
     */
    static public $indexing = false;

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        // Force the inheriting class to have a property type.
        if ( ! isset( $this->type ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field: the extending class must have property "type"' );
        }

        if ( empty( $label ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field: label can\'t be empty' );
        }

        $this->label = $label;

        $this->key = $key ?? $label;

        $this->name = $name ?? $label;

        $this->wrapper = [
            'width' => '',
            'class' => [],
            'id'    => '',
        ];

        $this->default_filter_arguments = [
            'priority'      => 10,
            'accepted_args' => 1,
            'no_suffix'     => false,
        ];

        if ( WP_DEBUG === true ) {
            $debug_backtrace = debug_backtrace();
            if ( ! empty( $debug_backtrace[1]['file'] ) && ! empty( $debug_backtrace[1]['line'] ) ) {
                $this->registered = $debug_backtrace[1]['file'] . ' at line ' . $debug_backtrace[1]['line'];
            }
        }
    }

    /**
     * Checks if the field's key is unique within the project scope. Throws a notice if not.
     *
     * @return void
     */
    protected function check_for_unique_key() {
        $key  = $this->key;
        $hash = spl_object_hash( $this );

        // Bail early if key not needed.
        if ( property_exists( $this, 'no_key' ) && $this->no_key ) {
            return;
        }

        if ( ! isset( self::$keys[ $key ] ) ) {
            // Save backtrace data if we want to debug.
            if ( ! empty( $this->registered ) ) {
                self::$keys[ $key ]           = [];
                self::$keys[ $key ]['string'] = $this->registered;
                self::$keys[ $key ]['hash']   = $hash;
            }
            // Otherwise just save the info that this key has already been used.
            else {
                self::$keys[ $key ] = '';
            }
        }
        elseif ( ! is_string( self::$keys[ $key ] ) && self::$keys[ $key ]['hash'] !== $hash ) {
            trigger_error( 'ACF Codifier: field key "' . $key . '" defined in ' . $this->registered . ' is already in use within another field which was defined in ' . self::$keys[ $key ]['string'] . '.', E_USER_NOTICE );
        }
        elseif ( isset( self::$keys[ $key ]['hash'] ) && self::$keys[ $key ]['hash'] !== $hash ) {
            trigger_error( 'ACF Codifier: field key "' . $key . '" is already in use within another field.', E_USER_NOTICE );
        }
    }

    /**
     * Prevent raw cloning.
     *
     * @return void
     */
    protected function __clone() {}

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param string $key  Field key.
     * @param string $name Field name (optional).
     * @return Geniem\ACF\Field
     */
    public function clone( string $key, string $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( ! empty( $name ) ) {
            $clone->set_name( $name );
        }

        return $clone;
    }

    /**
     * Export field in ACF's native format.
     *
     * @param boolean $register Whether the field is to be registered.
     * @param mixed   $parent   Possible parent object.
     *
     * @throws Exception Throws an exception if a key or a name is not defined.
     *
     * @return array
     */
    public function export( bool $register = false, $parent = null ) : ?array {
        if ( empty( $this->key ) ) {
            throw new Exception( 'Field ' . $this->label . ' does not have a key defined.' );
        }

        if ( empty( $this->name ) ) {
            throw new Exception( 'Field ' . $this->label . ' does not have a name defined.' );
        }

        \do_action( 'codifier/export/key=' . $this->key );

        $this->parent = $parent;

        if ( $register && ! empty( $this->filters ) ) {
            array_walk( $this->filters, function( $filter ) use ( $parent ) {
                $filter = wp_parse_args( $filter, $this->default_filter_arguments );

                if ( substr( $filter['filter'], 0, 10 ) === 'redipress/' ) {
                    if ( $this->get_is_user() ) {
                        switch ( $filter['filter'] ) {
                            case 'redipress/schema_fields':
                                $filter['filter'] = 'redipress/index/users/schema_fields';
                                break;
                        }
                    }
                    else {
                        switch ( $filter['filter'] ) {
                            case 'redipress/schema_fields':
                                $filter['filter'] = 'redipress/index/posts/schema_fields';
                                break;
                        }
                    }
                }

                if ( $filter['no_suffix'] ) {
                    add_filter( $filter['filter'], $filter['function'], $filter['priority'], $filter['accepted_args'] );
                }
                else {
                    add_filter( $filter['filter'] . $this->key, $filter['function'], $filter['priority'], $filter['accepted_args'] );
                }
            });
        }

        if ( $register && $this->redipress_get_queryable_status() === true ) {
            add_filter( 'acf/format_value/key=' . $this->key, \Closure::fromCallable( [ __CLASS__, 'redipress_additional_field' ] ), 10, 3 );
        }

        if ( $register && $this->hide_label ) {
            \Geniem\ACF\Codifier::hide_label( $this );
        }

        $obj = get_object_vars( $this );

        // Remove unnecessary properties from the exported array.
        unset( $obj['fields_var'] );
        unset( $obj['filters'] );
        unset( $obj['parent'] );

        if ( \property_exists( $this, 'fields_var' ) && ! empty( $obj[ $this->fields_var ] ) ) {
            $obj[ $this->fields_var ] = array_map( function( $field ) use ( $register ) {
                return $field->export( $register, $this );
            }, $obj[ $this->fields_var ] );

            $obj[ $this->fields_var ] = array_values( $obj[ $this->fields_var ] );
        }

        // Convert the wrapper class array to a space-separated string.
        if ( isset( $obj['wrapper']['class'] ) && ! empty( $obj['wrapper']['class'] ) ) {
            $obj['wrapper']['class'] = implode( ' ', $obj['wrapper']['class'] );
        }
        else {
            $obj['wrapper']['class'] = '';
        }

        // If we are registering the field, check that its key is unique.
        if ( $register ) {
            $this->check_for_unique_key();
        }

        if ( ! empty( $obj['conditional_logic'] ) ) {
            foreach ( $obj['conditional_logic'] as &$group ) {
                if ( count( $group ) > 0 ) {
                    foreach ( $group as &$rule ) {
                        if ( ! is_string( $rule['field'] ) ) {
                            $rule['field'] = $rule['field']->get_key();
                        }
                    }
                }
            }
        }

        return $obj;
    }

    /**
     * Get field group
     *
     * @param mixed $parent Parent object.
     *
     * @return \Geniem\ACF\Group
     */
    protected function get_field_group( $parent ) : ?\Geniem\ACF\Group {
        if ( $parent instanceof \Geniem\ACF\Group ) {
            return $parent;
        }
        else {
            return $this->get_field_group( $parent->parent );
        }
    }

    /**
     * If the field is for user or not
     *
     * @return bool
     */
    protected function get_is_user() : bool {
        if ( empty( $this->parent ) ) {
            return false;
        }

        $field_group = $this->get_field_group( $this->parent );

        $rules = $field_group->get_rule_groups();

        if ( empty( $rules ) ) {
            return false;
        }

        $flatten = array_merge( ...$rules );

        return array_reduce( $flatten, function( $carry, $item ) : bool {
            if ( $carry ) {
                return true;
            }

            if ( substr( $item['param'], 0, 5 ) === 'user_' && $item['operator'] === '==' ) {
                return true;
            }

            return false;
        }, false );
    }

    /**
     * Set label for the field.
     *
     * @param string $label Label to be set.
     * @return self
     */
    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the label of the field.
     *
     * @return string
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Set key for the field.
     *
     * @param string $key Key to be set.
     * @return self
     */
    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the key of the field.
     *
     * @return string
     */
    public function get_key() {
        return $this->key;
    }

    /**
     * Set name for the field.
     *
     * @param string $name Name to be set.
     * @return self
     */
    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the name of the field.
     *
     * @return string
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Get the type of the field.
     *
     * @return string
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * Set instruction text for the field.
     *
     * @param string $instructions Instructions.
     * @return self
     */
    public function set_instructions( string $instructions ) {
        $this->instructions = $instructions;

        return $this;
    }

    /**
     * Get the instruction text of the field.
     *
     * @return string
     */
    public function get_instructions() {
        return $this->instructions;
    }

    /**
     * Set the field to be required.
     *
     * @return self
     */
    public function set_required() {
        $this->required = 1;

        return $this;
    }

    /**
     * Set the field to be unrequired.
     *
     * @return self
     */
    public function set_unrequired() {
        $this->required = 0;

        return $this;
    }

    /**
     * Get the required status of the field.
     *
     * @return boolean
     */
    public function get_required() {
        return (boolean) $this->required;
    }

    /**
     * Add a conditional logic for the field.
     *
     * @param \Geniem\ACF\ConditionalLogicGroup $group The conditional logic group to be added.
     * @return self
     */
    public function add_conditional_logic( \Geniem\ACF\ConditionalLogicGroup $group ) {
        $rules = $group->get_rules();

        if ( count( $rules ) > 0 ) {
            $this->conditional_logic[] = $rules;
        }

        return $this;
    }

    /**
     * Get the conditional logic group that have been added to the group.
     *
     * @return \Geniem\ACF\ConditionalLogicGroup
     */
    public function get_conditional_logic() {
        return $this->conditional_logic;
    }

    /**
     * Set the wrapper width in percents.
     *
     * @param integer $width Width to be set.
     * @return self
     */
    public function set_wrapper_width( int $width ) {
        $this->wrapper['width'] = $width;

        return $this;
    }

    /**
     * Get the wrapper width.
     *
     * @return int
     */
    public function get_wrapper_width() {
        return $this->wrapper['width'];
    }

    /**
     * Set classes to be added for the field.
     *
     * @param mixed $classes The classes to be added either as an array or as a space-separated string.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     * @return self
     */
    public function set_wrapper_classes( $classes ) {
        if ( is_string( $classes ) ) {
            $this->wrapper['class'] = explode( ' ', $classes );
        }
        elseif ( is_array( $classes ) ) {
            $this->wrapper['class'] = $classes;
        }
        else {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field: set_wrapper_classes() argument must be an array or a string' );
        }

        return $this;
    }

    /**
     * Add a single wrapper class to be added for the field.
     *
     * @param string $class Class to be added.
     * @return self
     */
    public function add_wrapper_class( string $class ) {
        $this->wrapper['class'][] = $class;

        return $this;
    }

    /**
     * Remove a single wrapper class from the field.
     *
     * @param string $class Class to be removed.
     * @return self
     */
    public function remove_wrapper_class( string $class ) {
        $position = array_search( $class, $this->wrapper['class'], true );

        if ( ( $position !== false ) ) {
            unset( $this->wrapper['class'][ $position ] );
        }

        return $this;
    }

    /**
     * Get all wrapper classes that have been added for the field.
     *
     * @return array
     */
    public function get_wrapper_classes() {
        return $this->wrapper['class'];
    }

    /**
     * Add a wrapper id for the field.
     *
     * @param string $id Id to be added.
     * @return self
     */
    public function set_wrapper_id( string $id ) {
        $this->wrapper['id'] = $id;

        return $this;
    }

    /**
     * Get the id that has been added for the field.
     *
     * @return string
     */
    public function get_wrapper_id() {
        return $this->wrapper['id'];
    }

    /**
     * Set the default value for the field.
     *
     * @param mixed $value The default value.
     * @return self
     */
    public function set_default_value( $value ) {
        $this->default_value = $value;

        return $this;
    }

    /**
     * Get the default value of the field.
     *
     * @return mixed
     */
    public function get_default_value() {
        return $this->default_value;
    }

    /**
     * Hide the field label in the admin side
     *
     * @return self
     */
    public function hide_label() {
        $this->hide_label = true;

        return $this;
    }

    /**
     * Show the field label in the admin side
     *
     * @return self
     */
    public function show_label() {
        $this->hide_label = false;

        return $this;
    }

    /**
     * Get the label visibility status
     *
     * @return boolean
     */
    public function get_label_visibility() {
        return $this->hide_label;
    }

    /**
     * Unset a previously set filter.
     *
     * @param string $filter The key for the filter to be unset.
     * @return self
     */
    public function unset_filter( $filter ) {
        unset( $this->filters[ $filter ] );

        return $this;
    }

    /**
     * Add a filter method for the value before inserting it into RediSearch.
     *
     * @param callable $filter The filter method.
     * @return self
     */
    public function redipress_queryable_filter( callable $filter ) {
        $this->redipress_queryable_filter = $filter;

        return $this;
    }

    /**
     * Include this field's value in the RediPress search index.
     *
     * @param callable $callback Possible callback to run the value through before inserting into index.
     * @return self
     */
    public function redipress_include_search( callable $callback = null ) {
        $this->redipress_include_search          = true;
        $this->redipress_include_search_callback = $callback;

        $this->filters['redipress_include_search'] = [
            'filter'        => 'acf/update_value/key=',
            'function'      => \Closure::fromCallable( [ __CLASS__, 'redipress_include_search_filter' ] ),
            'priority'      => 10,
            'accepted_args' => 3,
        ];

        return $this;
    }

    /**
     * Exclude this field's value in the RediPress search index.
     *
     * @return self
     */
    public function redipress_exclude_search() {
        $this->redipress_include_search = false;

        unset( $this->filters['redipress_include_search'] );
        unset( $this->redipress_include_search_callback );

        return $this;
    }

    /**
     * Get RediPress search index status of this field.
     *
     * @return boolean
     */
    public function redipress_get_search_status() : bool {
        return isset( $this->filters['redipress_include_search'] );
    }

    /**
     * Use RediPress formatting functions in all suitable fields.
     *
     * @return void
     */
    public static function redipress_use_include_search_filter() {
        add_filter( 'acf/format_value', \Closure::fromCallable(( [ __CLASS__, 'redipress_include_search_filter' ] ) ), 10, 3 );
    }

    /**
     * Include the field's value in RediPress search index.
     *
     * @param mixed   $value   Field's value.
     * @param integer $post_id Post ID.
     * @param array   $field   ACF field object as an array.
     * @return mixed
     */
    protected static function redipress_include_search_filter( $value, $post_id, array $field ) {
        if ( ! empty( $field['redipress_include_search'] ) && $field['redipress_include_search'] === true ) {
            if ( \method_exists( '\\Geniem\\RediPress\\Index\\Index', 'store' ) ) {
                if ( ! empty( $field['redipress_include_search_callback'] ) ) {
                    $redipress_value = ( $field['redipress_include_search_callback'] )( $value );
                }
                else {
                    $redipress_value = $value;
                }

                if ( is_string( $redipress_value ) || is_array( $redipress_value ) || is_int( $redipress_value ) ) {
                    if ( strpos( $post_id, 'block_' ) !== false &&
                        ! ( $post_id = \Geniem\RediPress\Index\Index::indexing() ) // phpcs:ignore
                    ) {
                        $document_uri = filter_input( INPUT_SERVER, 'DOCUMENT_URI', \FILTER_SANITIZE_STRING );

                        $post_id = basename( $document_uri );
                    }

                    \Geniem\RediPress\Index\Index::store( $post_id, 'search_index', $redipress_value, 'concat_with_spaces' );
                }
                else {
                    \trigger_error( 'ACF Codifier: RediPress search include failed for "' . $field['key'] . '", value is not a string or an array.', \E_USER_WARNING );
                }
            }
        }

        return $value;
    }

    /**
     * Add this field's value as a queryable value to RediSearch index.
     *
     * @param string $field_name Optional field name to RediSearch index. Defaults to field name.
     * @param float  $weight     Optional weight for the search field.
     * @param string $method     The method to use with multiple values. Defaults to "use_last".
     *                           Possibilites: use_last, concat, concat_with_spaces, sum, custom (needs filter).
     * @return self
     */
    public function redipress_add_queryable(
        string $field_name = null,
        float $weight = 1.0,
        string $method = null
    ) {
        if ( ! \method_exists( '\\Geniem\\RediPress\\Index\\Index', 'store' ) ) {
            return $this;
        }

        $this->redipress_add_queryable            = true;
        $this->redipress_add_queryable_field_name = $field_name;
        $this->redipress_add_queryable_weight     = $weight;
        $this->redipress_add_queryable_method     = $method;

        add_action( 'codifier/export/key=' . $this->key, \Closure::fromCallable( [ $this, 'redipress_add_queryable_internal' ] ) );

        return $this;
    }

    /**
     * An internal function to be run with the add queryable functionality.
     */
    private function redipress_add_queryable_internal() {
        $field_name = $this->redipress_add_queryable_field_name;
        $weight     = $this->redipress_add_queryable_weight;
        $method     = $this->redipress_add_queryable_method;

        if ( ! $method ) {
            if ( $this->redipress_field_type === 'Tag' ) {
                $method = 'array_merge';
            }
            else {
                $method = 'use_last';
            }
        }

        $this->filters['redipress_add_queryable'] = [
            'filter'        => 'acf/format_value/key=',
            'function'      => function( $value, $post_id, $field ) use ( $method ) {
                if ( $this->redipress_add_queryable === true ) {
                    if ( ! empty( $this->redipress_queryable_filter ) ) {
                        $redipress_value = ( $this->redipress_queryable_filter )( $value );
                    }
                    else {
                        $redipress_value = $value;
                    }

                    if ( strpos( $post_id, 'block_' ) !== false &&
                        ! ( $post_id = \Geniem\RediPress\Index\PostIndex::indexing() ) // phpcs:ignore
                    ) {
                        $document_uri = filter_input( INPUT_SERVER, 'DOCUMENT_URI', \FILTER_SANITIZE_STRING );

                        $post_id = basename( $document_uri );
                    }

                    \Geniem\RediPress\Index\Index::store(
                        $post_id,
                        $this->redipress_add_queryable_field_name ?? $field['name'],
                        $redipress_value,
                        $method
                    );
                }

                return $value;
            },
            'priority'      => 11,
            'accepted_args' => 3,
        ];

        $this->filters['redipress_add_queryable_single'] = [
            'filter'        => 'acf/update_value/key=',
            'function'      => function( $value, $post_id, $field ) {
                $users = false;

                if ( $this->get_is_user() ) {
                    $user_id = str_replace( 'user_', '', $post_id );

                    $user = get_user_by( 'id', $user_id );

                    // If the user does not exist, we don't know what to do so just bail out.
                    if ( ! $user ) {
                        return $value;
                    }

                    $doc_id = \Geniem\RediPress\Index\UserIndex::get_document_id( $user );

                    $users = true;
                }
                elseif ( is_numeric( $post_id ) ) {
                    $doc_id = \Geniem\RediPress\Index\PostIndex::get_document_id( get_post( $post_id ) );
                }
                elseif ( strpos( $post_id, 'block_' ) !== false ) {
                    if ( ! ( $post_id = \Geniem\RediPress\Index\Index::indexing() ) ) {
                        $document_uri = filter_input( INPUT_SERVER, 'DOCUMENT_URI', \FILTER_SANITIZE_STRING );

                        $post_id = basename( $document_uri );
                    }

                    $doc_id = \Geniem\RediPress\Index\PostIndex::get_document_id( get_post( $post_id ) );
                }

                if ( ! empty( $doc_id ) ) {
                    $field_name = $this->redipress_add_queryable_field_name ?? $field['name'];

                    if ( ! empty( $this->redipress_queryable_filter ) ) {
                        $redipress_value = ( $this->redipress_queryable_filter )( $value );
                    }
                    else {
                        $redipress_value = $value;
                    }

                    if ( strtolower( $this->redipress_field_type ) === 'tag' && is_array( $redipress_value ) ) {
                        $redipress_value = implode( \Geniem\RediPress\Index\Index::get_tag_separator(), $redipress_value );
                    }

                    // RediSearch doesn't accept boolean values
                    if ( is_bool( $redipress_value ) ) {
                        $redipress_value = (int) $redipress_value;
                    }

                    \Geniem\RediPress\update_value( $doc_id, $field_name, $redipress_value, $this->redipress_add_queryable_field_weight ?? 1, $users );
                }

                return $value;
            },
            'priority'      => 11,
            'accepted_args' => 3,
        ];

        $this->filters['redipress_schema_fields'] = [
            // This gets changed to the proper filter in the export method.
            'filter'        => 'redipress/schema_fields',
            'function'      => function( $fields ) {

                $type = '\\Geniem\\RediPress\\Entity\\' . $this->redipress_field_type . 'Field';

                $field_args = [
                    'name' => $this->redipress_add_queryable_field_name ?? $this->name,
                ];

                if ( $this->redipress_field_type === 'Text' ) {
                    $field_args['weight'] = $this->redipress_add_queryable_weight;
                }

                if ( class_exists( $type ) ) {
                    $field = new $type( $field_args );
                }
                else {
                    trigger_error(
                        'ACF Codifier: RediPress field ' . $field_args['name'] . ' type ' . $type . ' is not supported. Using "Text"',
                        E_USER_NOTICE
                    );

                    $field = new \Geniem\RediPress\Entity\TextField( $field_args );
                }

                $fields[] = $field;

                return $fields;
            },
            'priority'      => 11,
            'accepted_args' => 3,
            'no_suffix'     => true,
        ];
    }

    /**
     * Remove this field from being queryable in RediSearch index.
     *
     * @return self
     */
    public function redipress_remove_queryable() {
        $this->redipress_add_queryable = false;

        remove_action( 'codifier/export/key=' . $this->key, \Closure::fromCallable( [ $this, 'redipress_add_queryable_internal' ] ) );

        return $this;
    }

    /**
     * Whether this field is queryable in RediSearch index or not.
     *
     * @return boolean
     */
    public function redipress_get_queryable_status() : bool {
        return $this->redipress_add_queryable;
    }

    /**
     * Register a value validation function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function validate_value( callable $function, int $priority = 10 ) {
        $this->filters['validate_value'] = [
            'filter'        => 'acf/validate_value/key=',
            'function'      => $function,
            'priority'      => $priority,
            'accepted_args' => 4,
        ];

        return $this;
    }

    /**
     * Register a value formatting function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function format_value( callable $function, int $priority = 11 ) {
        $this->filters['format_value'] = [
            'filter'        => 'acf/format_value/key=',
            'function'      => $function,
            'priority'      => $priority,
            'accepted_args' => 3,
        ];

        return $this;
    }

    /**
     * Register a value loading function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function load_value( callable $function, int $priority = 10 ) {
        $this->filters['load_value'] = [
            'filter'        => 'acf/load_value/key=',
            'function'      => $function,
            'priority'      => $priority,
            'accepted_args' => 3,
        ];

        return $this;
    }

    /**
     * Register a value updating function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function update_value( callable $function, int $priority = 10 ) {
        $this->filters['update_value'] = [
            'filter'        => 'acf/update_value/key=',
            'function'      => $function,
            'priority'      => $priority,
            'accepted_args' => 3,
        ];

        return $this;
    }

    /**
     * Register a field preparing function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function prepare_field( callable $function, int $priority = 10 ) {
        $this->filters['prepare_field'] = [
            'filter'        => 'acf/prepare_field/key=',
            'function'      => $function,
            'priority'      => $priority,
            'accepted_args' => 1,
        ];

        return $this;
    }

    /**
     * Register a field loading function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function load_field( callable $function, int $priority = 10 ) {
        $this->filters['load_field'] = [
            'filter'        => 'acf/load_field/key=',
            'function'      => $function,
            'priority'      => $priority,
            'accepted_args' => 1,
        ];

        return $this;
    }

    /**
     * Register a field rendering function for the field
     *
     * @param callable $function A function to register.
     * @param int      $priority The filter priority.
     * @return self
     */
    public function render_field( callable $function, int $priority = 10 ) {
        $this->codifier_unique_id = uniqid( '', true );

        $this->filters[ 'render_field_' . $this->codifier_unique_id ] = [
            'filter'        => 'acf/render_field/type=' . $this->type,
            'function'      => function( $field ) use ( $function ) {
                if (
                    ! empty( $field['codifier_unique_id'] ) &&
                    $this->codifier_unique_id === $field['codifier_unique_id']
                ) {
                    return $function( $field );
                }
                else {
                    return $field;
                }
            },
            'priority'      => $priority,
            'accepted_args' => 1,
            'no_suffix'     => true,
        ];

        return $this;
    }

    /**
     * Set the RediSearch index field type for the field
     *
     * @param string $type
     * @return self
     */
    public function redipress_set_field_type( string $type ) {
        $type = ucwords( $type );

        $class = '\\Geniem\\RediPress\\Entity\\' . $type . 'Field';

        if ( class_exists( $class ) ) {
            $this->redipress_field_type = $type;
        }
        else {
            trigger_error(
                'ACF Codifier: RediPress field ' . $this->name . ' type ' . $type . ' is not supported. Using "' . $this->redipress_field_type . '"',
                E_USER_NOTICE
            );
        }

        return $this;
    }

    /**
     * A wrapper for ACF get_fields to get the values for indexing.
     *
     * @param \WP_Post|\WP_User $item The WP Post or WP_User object.
     * @return void
     */
    public static function redipress_get_fields( $item ) {
        // Only add the filter once.
        static $filter_added = false;

        if ( ! $filter_added ) {
            self::redipress_use_include_search_filter();
            $filter_added = true;
        }

        if ( $item instanceof \WP_Post ) {

            if ( \has_blocks( $item->post_content ) ) {
                $blocks = parse_blocks( $item->post_content );

                array_walk( $blocks, function( $block ) {
                    render_block( $block );
                });
            }

            \get_fields( $item->ID, true );
        }
        elseif ( $item instanceof \WP_User ) {
            \get_fields( 'user_' . $item->ID, true );
        }
    }

    /**
     * A helper function to use to enable indexing the post outside save action.
     *
     * @param mixed $value   The value.
     * @param int   $post_id The Post ID.
     * @param array $field   The field object as an array.
     * @return mixed
     */
    protected function redipress_additional_field( $value, $post_id, $field ) {
        if ( $field['redipress_add_queryable'] === true ) {
            if ( ! empty( $field['redipress_queryable_filter'] ) ) {
                $redipress_value = ( $field['redipress_queryable_filter'] )( $value );
            }
            else {
                $redipress_value = $value;
            }

            \Geniem\RediPress\Index\Index::store(
                $post_id,
                $field['redipress_add_queryable_field_name'] ?? $field['name'],
                $redipress_value,
                $field['redipress_add_queryable_method'] ?? 'use_last'
            );
        }
        return $value;
    }

    /**
     * A helper function to detect if we are running ACF's update_field function.
     *
     * @return boolean
     */
    public static function running_update_field() {
        return array_reduce( \debug_backtrace(), function( bool $carry, array $item ) { // phpcs:ignore
            if ( ! empty ( $carry ) ) {
                return $carry;
            }

            if ( ! empty( $item['function'] ) && $item['function'] === 'update_field' ) {
                return true;
            }
            else {
                return false;
            }
        }, false );
    }
}
