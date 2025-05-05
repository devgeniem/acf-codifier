<?php
/**
 * Codifier Component manager interface.
 */

namespace Geniem\ACF\Interfaces;

/**
 * Interface ComponentManager
 *
 * @package Geniem\ACF
 */
interface ComponentFactory {

    /**
     * ComponentManager constructor.
     *
     * @param Component $component A component class instance.
     */
    public function __construct( Component $component );

}
