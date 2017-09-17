<?php
namespace Geniem\ACF;

class RuleGroup {
    protected $rules;

    public function __construct() {
        $this->rules = [];
    }

    public function add_rule( string $param, string $operator, $value ) {
        if ( ! in_array( $operator, [ '==', '!=' ] ) ) {
            throw new Exception ('Geniem\ACF\RuleGroup: add_role() does not accept argument "' . $operator .'"' );
        }

        $this->rules[] = [ 'param' => $param, 'operator' => $operator, 'value' => $value ];

        return $this;
    }

    public function get_rules() {
        return $this->rules;
    }
}