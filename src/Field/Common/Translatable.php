<?php
/**
 * ACF Codifier Translatable trait
 */

namespace Geniem\ACF\Field\Common;

/**
 * Translatable trait
 */
trait Translatable {
    /**
     * The field translations value
     *
     * @var string
     */
    protected $translations;

    /**
     * Set field translations value
     *
     * @see https://polylang.pro/doc/working-with-acf-pro/#customize-acf-fields
     *
     * @throws \Geniem\ACF\Exception Throws error if translations is not valid.
     * @param string $translations The translations value to set.
     * @return self
     */
    public function set_translations( string $translations ) {
        $category = \acf_get_field_type_prop( $this->type, 'category' );
        if ( 'layout' === $category ) {
            throw new \Geniem\ACF\Exception( self::class . ': set_translations() can\'t be called on this field type.' );
        }

        $choices = [ 'ignore', 'copy_once', 'sync' ];
        switch ( $this->type ) {
            case 'text':
            case 'textarea':
            case 'wysiwyg':
            case 'oembed':
            case 'url':
            case 'email':
                $choices[] = 'translate';
                break;
        }

        if ( ! \in_array( $translations, $choices ) ) {
            throw new \Geniem\ACF\Exception( self::class . ': set_translations() does not accept argument "' . $translations . '"' );
        }

        $this->translations = $translations;

        return $this;
    }

    /**
     * Get the field translations value
     *
     * @return string
     */
    public function get_translations() {
        return $this->translations;
    }
}
