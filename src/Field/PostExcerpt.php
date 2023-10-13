<?php
/**
 * Acf Codifier Post Excerpt field
 */

namespace Geniem\ACF\Field;

/**
 * Class Excerpt
 */
class PostExcerpt extends \Geniem\ACF\Field\Textarea {

    /**
     * Overridden constructor to provide our special functionality
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        // Call the real constructor
        parent::__construct( $label, $key, $name );

        // Add the post_excerpt handling
        $this->update_value( [ $this, 'save_post_excerpt' ] );

        // Add the post_excerpt loading
        $this->load_value( [ $this, 'load_post_excerpt' ] );
    }

    /**
     * Save the value to post_excerpt
     *
     * @param string $value    The value of the field.
     * @param integer $post_id Post ID.
     * @param array $field     Field object.
     * @return void
     */
    public function save_post_excerpt( string $value, int $post_id, array $field ) {
        // Update the post excerpt
        wp_update_post([
            'ID'           => $post_id,
            'post_excerpt' => $value,
        ]);

        // Don't save the value to anywhere else
        return null;
    }

    /**
     * Load the value from post_excerpt
     *
     * @param string $value    The value of the field.
     * @param integer $post_id Post ID.
     * @param array $field     Field object.
     * @return void
     */
    public function load_post_excerpt( string $value, int $post_id, array $field ) {
        global $post;

        // Use global post object if it's appropriate.
        if ( $post->ID === $post_id ) {
            $post_object = $post;
        }
        else {
            $post_object = get_post( $post_id );
        }

        // Return the post excerpt for its value.
        return $post_object->post_excerpt;
    }
}
