<?php
/**
 * Acf codifier Radio button field
 */

namespace Geniem\ACF\Field;

/**
 * Class Radio
 */
class Radio extends Checkbox {
    /**
     * Field type
     *
     * @var string
     */
    protected $type = 'radio';

    /**
     * Can user add a custom choice
     * Same as checkbox allow_custom
     *
     * @var integer
     */
    protected $other_choice;

    /**
     * Should custom values be saved to default possibilities
     * Same as checkbox save_custom
     *
     * @var integer
     */
    protected $save_other_choice;

    /**
     * Allow other choice
     *
     * @return self
     */
    public function allow_other_choice() {
        $this->other_choice = 1;

        return $this;
    }

    /**
     * Disallow other choice
     *
     * @return self
     */
    public function disallow_other_choice() {
        $this->other_choice = 0;

        return $this;
    }

    /**
     * Get other choice values status
     *
     * @return integer
     */
    public function get_other_choice() {
        return $this->other_choice;
    }

    /**
     * Allow saving custom values to default values
     *
     * @return self
     */
    public function allow_save_other_choice() {
        $this->save_other_choice = 1;

        return $this;
    }

    /**
     * Disallow saving custom values to default values
     *
     * @return self
     */
    public function disallow_save_other_choice() {
        $this->save_other_choice = 0;

        return $this;
    }

    /**
     * Get save other choice status
     *
     * @return integer
     */
    public function get_save_other_choice() {
        return $this->save_other_choice;
    }

    /**
     * Set choices for the checkbox
     *
     * @param array $choices Choices as strings.
     * @return self
     */
    public function set_choices( array $choices ) {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Add a choice.
     *
     * @param string $choice Choice to be added.
     * @param mixed  $value Value to save if choice selected, uses $choice if not set.
     * @return self
     */
    public function add_choice( string $choice, $value ) {
        if ( ! isset( $value ) ) {
            $value = $choice;
        }

        $this->choices[ $value ] = $choice;

        return $this;
    }

    /**
     * Remove a choice.
     *
     * @param string $choice Choice to be removed.
     * @return self
     */
    public function remove_choice( string $choice ) {
        $position = array_search( $choice, $this->choices );

        if ( ( $position !== false ) ) {
            unset( $this->choices[ $position ] );
        }

        return $this;
    }

    /**
     * Get all choices.
     *
     * @return array
     */
    public function get_choices() {
        return $this->choices;
    }
}
