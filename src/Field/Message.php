<?php
/**
 * ACF Codifier Message field
 */

namespace Geniem\ACF\Field;

/**
 * Class Message
 */
class Message extends \Geniem\ACF\Field {
    /**
     * The field type
     *
     * @var string Checkbox
     */
    protected $type = 'message';

    /**
     * Message text
     *
     * @var string
     */
    protected $message;

    /**
     * Newline type
     *
     * @var string
     */
    protected $new_lines;

    /**
     * Escape html
     *
     * @var integer
     */
    protected $esc_html;

    /**
     * Message doesn't need a key.
     *
     * @var boolean
     */
    public $no_key = true;

    /**
     * Set message
     *
     * @param  string $message Message.
     * @return self
     */
    public function set_message( string $message ) {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string Message.
     */
    public function get_message() {
        return $this->message;
    }

    /**
     * Set newline handling
     *
     * @throws \Geniem\ACF\Exception Info about incorrect type.
     * @param  string $type Newline type.
     * @return self
     */
    public function set_new_lines( string $type ) {
        if ( ! in_array( $type, [ 'wpautop', 'br', '' ] ) ) {
            throw new \Geniem\ACF\Exception( 'Geniem\ACF\Field\Message: set_new_lines() does not accept argument "' . $type . '"' );
        }

        $this->new_lines = $type;

        return $this;
    }

    /**
     * Get newline type
     *
     * @return string Newline type.
     */
    public function get_new_lines() {
        return $this->new_lines;
    }

    /**
     * Enable escape html
     *
     * @return self
     */
    public function use_esc_html() {
        $this->esc_html = 1;

        return $this;
    }

    /**
     * Disable escape html
     *
     * @return self
     */
    public function no_esc_html() {
        $this->esc_html = 0;

        return $this;
    }

    /**
     * Get escape html
     *
     * @return integer Escape html status.
     */
    public function esc_html() {
        return $this->esc_html;
    }
}
