<?php
/**
 * ACF Codifier PHP field
 */

namespace Geniem\ACF\Field;

/**
 * Class Message
 */
class PHP extends \Geniem\ACF\Field {
    /**
     * The field type
     *
     * @var string Checkbox
     */
    protected $type = 'php';

    /**
     * Code to run
     *
     * @var callable
     */
    public $code;

    /**
     * Run the attached code.
     *
     * @param callable $callable The code to run.
     * @return self
     */
    public function run( $callable ) {
        if ( is_callable( $callable ) ) {
            $this->code = $callable;
        }

        return $this;
    }
}
