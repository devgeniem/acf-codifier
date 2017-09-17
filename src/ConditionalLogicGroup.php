<?php
namespace Geniem\ACF;

class ConditionalLogicGroup {
    protected $rules;

    public function __construct() {
        $this->rules = [];
    }

    public function add_rule( string $field, string $operator, boolean $value ) {
        if ( ! in_array( $operator, [ '==', '!=' ] ) ) {
            throw new Exception ('Geniem\ACF\ConditionalRule: add_role() does not accept argument "' . $operator .'"' );
        }

        $this->rules[] = [ 'field' => $field, 'operator' => $operator, 'value' => (int) $value ];

        return $this;
    }

    public function get_rules() {
        return $this->rules;
    }
}