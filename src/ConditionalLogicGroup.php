<?php
/**
 * ACF Codifier conditional logic class.
 */

namespace Geniem\ACF;

/**
 * Class ConditionalLogicGroup
 */
class ConditionalLogicGroup {
    /**
     * The conditional logic rules
     *
     * @var array Conditional Logic rules to be stored
     */
    protected $rules = [];

    /**
     * Add a conditional logic rule.
     *
     * @param string $field         The slug of the field to be compared to.
     * @param string $operator      Operator to be used, either '==' or '!='.
     * @param mixed  $value         Value to be used in comparison.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function add_rule( string $field, string $operator, $value ) {
        // Check for valid values for the parameters.
        if ( ! in_array( $operator, [ '==', '!=' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\ConditionalRule: add_role() does not accept argument "' . $operator . '"' );
        }
        if ( ! ( $field instanceof \Geniem\ACF\Field || is_string( $field ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Clone: add_role() requires an argument that is a string or type "\Geniem\ACF\Field"' );
        }
        if ( is_string( $field ) ) {
            $key = $field;
        } else {
            $key = $field->get_key();
        }
        $this->rules[] = [ 'field' => $key, 'operator' => $operator, 'value' => $value ];
        return $this;
    }

    /**
     * Get added conditional logic rules.
     *
     * @return array
     */
    public function get_rules() {
        return $this->rules;
    }
}
