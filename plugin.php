<?php
/*
Plugin Name: ACF Codifier
Plugin URI: https://github.com/devgeniem/acf-codifier
Description: A helper class to make defining ACF field groups and fields easier in the code.
Version: 1.3.2
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

Codifier::init();
