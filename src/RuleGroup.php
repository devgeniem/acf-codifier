<?php
/**
 * ACF Codifier Rule Group class
 */

namespace Geniem\ACF;

/**
 * Class RuleGroup
 */
class RuleGroup {
    /**
     * Array of ACF location rules.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Add a location rule to the rule group
     *
     * @param string $param          Parameter to add.
     * @param string $operator       Operator to be used, either '==' or '!='.
     * @param string $value          Value to be compared the parameter value to.
     * @throws \Geniem\ACF\Exception Throw error if given parameter is not valid.
     * @return self
     */
    public function add_rule( string $param, string $operator, string $value ) {
        // Check for valid values for the parameter.
        if ( ! in_array( $operator, [ '==', '!=' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\RuleGroup: add_role() does not accept argument "' . $operator . '"' );
        }

        $this->rules[] = [ 'param' => $param, 'operator' => $operator, 'value' => $value ];

        return $this;
    }

    /**
     * Get all rules in the rule group.
     *
     * @return array
     */
    public function get_rules() {
        return $this->rules;
    }
}
