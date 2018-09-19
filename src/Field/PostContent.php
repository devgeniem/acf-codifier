<?php
/**
 * Acf Codifier Post Content field
 */

namespace Geniem\ACF\Field;

/**
 * Class PostContent
 */
class PostContent extends \Geniem\ACF\Field\Wysiwyg {

    /**
     * Overriden constructor to provide our special functionality
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        // Call the real constructor
        parent::__construct( $label, $key, $name );

        // Add the post_content handling
        $this->update_value( [ $this, 'save_post_content' ] );

        // Add the post_content loading
        $this->load_value( [ $this, 'load_post_content' ] );
    }

    /**
     * Save the value to post_content
     *
     * @param string $value    The value of the field.
     * @param integer $post_id Post ID.
     * @param array $field     Field object.
     * @return void
     */
    public function save_post_content( string $value, int $post_id, array $field ) {
        // Update the post content
        wp_update_post([
            'ID'           => $post_id,
            'post_content' => $value,
        ]);

        // Don't save the value to anywhere else
        return null;
    }

    /**
     * Load the value from post_content
     *
     * @param string $value    The value of the field.
     * @param integer $post_id Post ID.
     * @param array $field     Field object.
     * @return void
     */
    public function load_post_content( string $value, int $post_id, array $field ) {
        global $post;

        // Use global post object if it's appropriate.
        if ( $post->ID === $post_id ) {
            $post_object = $post;
        }
        else {
            $post_object = get_post( $post_id );
        }

        // Return the post content for its value.
        return $post_object->post_content;
    }
}
