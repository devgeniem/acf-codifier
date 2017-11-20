<?php
/*
Plugin Name: ACF Codifier
Plugin URI: https://github.com/devgeniem/acf-codifier
Description: A helper class to make defining ACF field groups and fields easier in the code.
Version: 0.1.0
Author: Geniem Oy
Author URI: https://geniem.fi
License: GPLv2
*/

namespace Geniem\ACF;

/**
 * ACF Codifier
 */
class Codifier {
    /**
     * ACF field labels to be hidden on the admin side
     *
     * @var array
     */
    protected static $hidden_labels = [];

    /**
     * Init function for registering actions
     *
     * @return void
     */
    public static function init() {
        add_action( 'admin_head', __CLASS__ . '::hide_labels' );
    }

    /**
     * Hide ACF field labels from desired fields
     *
     * @return void
     */
    public static function hide_labels() {
        if ( ! empty( self::$hidden_labels ) && is_array( self::$hidden_labels ) ) {

            echo "<style>\n";
            foreach ( self::$hidden_labels as $field ) {
                if ( is_string( $field ) ) {
                    $key = $field;
                }
                else {
                    $key = $field->get_key();
                }

                echo 'div.acf-field.acf-field-' . $key . " label { display: none; }\n";
            }

            echo "</style>\n";
        }
    }

    /**
     * Hides an ACF field label
     *
     * @param mixed $field Either a field object or field's key.
     * @return void
     */
    public static function hide_label( $field ) {
        if ( is_string( $field ) ) {
            $key = $field;
        }
        else {
            $key = $field->get_key();
        }

        self::$hidden_labels[ $key ] = $field;
    }

    /**
     * Shows a previously hidden ACF field label
     *
     * @param mixed $field Either a field object or field's key.
     * @return void
     */
    public static function show_field( $field ) {
        if ( is_string( $field ) ) {
            $key = $field;
        }
        else {
            $key = $field->get_key();
        }

        unset( self::$hidden_labels[ $key ] );
    }

    /**
     * Returns true or false if an ACF field's label has been hidden
     *
     * @param mixed $field Either a field object or field's key.
     * @return boolean
     */
    public static function get_label_visibility( $field ) {
        if ( is_string( $field ) ) {
            $key = $field;
        }
        else {
            $key = $field->get_key();
        }

        return isset( self::$hidden_labels[ $key ] );
    }
}

Codifier::init();
