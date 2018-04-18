<?php
/**
 * ACF Codifier Groupable groupable field abstract class
 */

namespace Geniem\ACF\Field;

/**
 * Abstract class GroupableField
 */
abstract class GroupableField extends \Geniem\ACF\Field {

    /**
     * Field variable
     *
     * @var string
     */
    protected $fields_var = 'sub_fields';

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        // Add Groupable to its property to be pseudo-extended
        $this->groupable = new \Geniem\ACF\Field\Groupable( $this );

        // Call the original constructor
        parent::__construct( $label, $key, $name );

        // Ensure that the container for the subfields is an array
        if ( ! is_array( $this->{ $this->fields_var } ) ) {
            $this->{ $this->fields_var } = [];
        }
    }

    /**
     * Magic function __call
     *
     * @param string $name       Function name to call.
     * @param array  $arguments  Function arguments.
     * @return mixed             Return value of the function.
     */
    public function __call( $name, array $arguments ) {
        // Call the method from groupable
        return \call_user_func_array( [ $this->groupable, $name ], $arguments );
    }

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param string $key  Field key.
     * @param string $name Field name (optional).
     * @return Geniem\ACF\Field
     */
    public function clone( $key, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $field_map = [];

        $clone->{ $this->fields_var } = array_map( function( $field ) use ( $key, &$field_map ) {
            $clone = $field->clone( $key . '_' . $field->get_key() );

            $field_map[] = [
                'original' => $field,
                'cloned'   => $clone,
            ];

            return $clone;

        }, $clone->{ $this->fields_var });

        if ( ! empty( $field_map ) ) {
            $clone->{ $this->fields_var } = array_map( function( $field ) use ( $field_map ) {
                if ( count( $field->conditional_logic ) > 0 ) {
                    foreach ( $field->conditional_logic as &$logics ) {
                        if ( count( $logics ) > 0 ) {
                            foreach ( $logics as &$logic ) {
                                foreach ( $field_map as $map ) {
                                    if ( $map['original'] === $logic['field'] ) {
                                        $logic['field'] = $map['cloned'];
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }

                return $field;
            }, $clone->{ $this->fields_var });
        }

        $clone->groupable = new \Geniem\ACF\Field\Groupable( $clone );
        $clone->update_self( $clone );

        return $clone;
    }
}
