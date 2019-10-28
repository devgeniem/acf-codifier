<?php
/**
 * ACF Codifier Groupable groupable field abstract class
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field,
    Geniem\ACF\Field\Common\Groupable,
    Geniem\ACF\Interfaces\Groupable as GroupableInterface;

/**
 * Abstract class GroupableField
 */
abstract class GroupableField extends Field implements GroupableInterface {

    /**
     * Import the groupable functionalities
     */
    use Groupable;

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        // Call the original constructor
        parent::__construct( $label, $key, $name );

        // Ensure that the container for the subfields is an array
        if ( ! is_array( $this->{ $this->fields_var() } ) ) {
            $this->{ $this->fields_var() } = [];
        }
    }

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param string $key  Field key.
     * @param string $name Field name (optional).
     * @return Field
     */
    public function clone( string $key, string $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $field_map = [];

        $clone->{ $this->fields_var() } = array_map( function( $field ) use ( $key, &$field_map ) {
            $clone = $field->clone( $key . '_' . $field->get_key() );

            $field_map[] = [
                'original' => $field,
                'cloned'   => $clone,
            ];

            return $clone;

        }, $clone->{ $this->fields_var() });

        if ( ! empty( $field_map ) ) {
            $clone->{ $this->fields_var() } = array_map( function( $field ) use ( $field_map ) {
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
            }, $clone->{ $this->fields_var() });
        }

        return $clone;
    }
}
