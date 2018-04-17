<?php
/**
 * Acf codifier gallery class
 */

namespace Geniem\ACF\Field;

/**
 * Class Gallery
 */
class Gallery extends Image {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'gallery';

    /**
     * Minimum amount of images to show
     *
     * @var integer
     */
    protected $min;

    /**
     * Maximum amount of images to show
     *
     * @var integer
     */
    protected $max;

    /**
     * Set minimum amount
     *
     * @param integer $min Minimum amount.
     * @return self
     */
    public function set_min( int $min ) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get minimum amount
     *
     * @return integer Minimum amount
     */
    public function get_min() {
        return $this->min;
    }

    /**
     * Set maximum amount
     *
     * @param integer $max Maximum amount.
     * @return self
     */
    public function set_max( int $max ) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get maximum amount
     *
     * @return integer Maximum amount
     */
    public function get_max() {
        return $this->max;
    }

    /**
     * Register a attachment validating function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function validate_attachment( $function ) {
        $this->filters['validate_attachment'] = [
            'filter'        => 'acf/validate_attachment/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 4,
        ];

        return $this;
    }

    /**
     * Register a upload prefiltering function for the field
     *
     * @param callable $function A function to register.
     * @return self
     */
    public function upload_prefilter( $function ) {
        $this->filters['upload_prefilter'] = [
            'filter'        => 'acf/upload_prefilter/key=',
            'function'      => $function,
            'priority'      => 10,
            'accepted_args' => 3,
        ];

        return $this;
    }
}
