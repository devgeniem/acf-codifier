<?php
/*
Plugin Name: ACF Codifier
Plugin URI: https://github.com/devgeniem/acf-codifier
Description: A helper class to make defining ACF field groups and fields easier in the code.
Version: 1.17.0-beta
Author: Miika Arponen / Geniem Oy
Author URI: https://geniem.fi
License: GPL-3.0
*/

namespace Geniem\ACF;

// Check if Composer has been initialized in this directory.
// Otherwise we just use global composer autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Register the included fields to the ACF
if ( file_exists( __DIR__ . '/src/Fields/PHP.php' ) ) {
    add_action( 'acf/include_field_types' , function() {
        require_once __DIR__ . '/src/Fields/PHP.php';
    });
}

Codifier::init();
