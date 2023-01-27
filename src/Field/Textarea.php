<?php
/**
 * Acf codifier textarea field
 */

namespace Geniem\ACF\Field;

use Geniem\ACF\Field\Common\Disabled;
use Geniem\ACF\Field\Common\Placeholder;
use Geniem\ACF\Field\Common\ReadonlyTrait;

/**
 * Class Textarea
 */
class Textarea extends \Geniem\ACF\Field {

    use ReadonlyTrait, Disabled, Placeholder;

    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'textarea';

    /**
     * Field placeholder
     *
     * @var string
     */
    protected $placeholder;

    /**
     * Max length for string
     *
     * @var integer
     */
    protected $maxlength;

    /**
     * How new lines are treated
     *
     * @var string
     */
    protected $new_lines;

    /**
     * Max amount of rows
     *
     * @var integer
     */
    protected $rows;

    /**
     * Set text max length
     *
     * @param integer $maxlength New max length.
     * @return self
     */
    public function set_maxlength( int $maxlength ) {
        $this->maxlength = $maxlength;

        return $this;
    }

    /**
     * Set new line handling
     *
     * @throws \Geniem\ACF\Exception Throws error if new_lines is not valid.
     * @param string $new_lines New line handling way.
     * @return self
     */
    public function set_new_lines( string $new_lines = 'wpautop' ) {
        if ( ! in_array( $new_lines, [ 'wpautop', 'br', '' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Textarea: set_new_lines() does not accept argument "' . $new_lines . '"' );
        }

        $this->new_lines = $new_lines;

        return $this;
    }

    /**
     * Get new line handling way
     *
     * @return string
     */
    public function get_new_lines() {
        return $this->new_lines;
    }

    /**
     * Set max rows
     *
     * @param integer $rows Max rows.
     * @return self
     */
    public function set_rows( int $rows ) {
        $this->rows = $rows;

        return $this;
    }

    /**
     * Get max rows
     *
     * @return integer
     */
    public function get_rows() {
        return $this->rows;
    }
}
