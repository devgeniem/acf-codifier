<?php
/**
 * Advanced Forms integration
 */

namespace Geniem\ACF\External;

class AdvancedForms {

    /**
     * Constructor
     */
    public function __construct() {
        \add_action( 'acf/init', [ $this, 'fix_action_priority' ], 2, 0 );
    }

    /**
     * Fix the action priority for submission handlings to match Codifier's register hook.
     *
     * @return void
     */
    public function fix_action_priority() {
        if ( \function_exists( 'AF' ) ) {
            $acf_core_forms_submissions = AF()->classes['core_forms_submissions'];

            \remove_action( 'init', [ $acf_core_forms_submissions, 'pre_form' ], 10 );
            \add_action( 'init', [ $acf_core_forms_submissions, 'pre_form' ], 9999, 0 );
        }
    }
}

new AdvancedForms();
