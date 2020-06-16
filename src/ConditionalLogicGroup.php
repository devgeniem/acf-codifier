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
     * @param mixed  $field         The slug of the field to be compared to.
     * @param string $operator      Operator to be used. Possibilities: '==', '!=', '!=empty', '==empty', '==pattern', '==contains', '<' or '>'.
     * @param mixed  $value         Value to be used in comparison.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function add_rule( $field, string $operator, $value ) {
        // Check for valid values for the parameters.
        if ( ! in_array( $operator, [ '==', '!=', '!=empty', '==empty', '==pattern', '==contains', '<', '>' ], true ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\ConditionalRule: add_role() does not accept argument "' . $operator . '"' );
        }
        if ( ! ( $field instanceof \Geniem\ACF\Field || is_string( $field ) ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Clone: add_role() requires an argument that is a string or type "\Geniem\ACF\Field"' );
        }

        $this->rules[] = [
            'field'    => $field,
            'operator' => $operator,
            'value'    => $value,
        ];

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
