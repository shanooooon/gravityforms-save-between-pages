<?php

/*
Plugin Name: Gravity Forms Save Between Pages Add-On
Plugin URI:  https://github.com/shanooooon/gravityforms-save-between-pages
Description: Progressively save user the entries on multi-page Gravity Forms between each page
Version:     0.1.0
Author:      Shanon Scully
Author URI:  http://shanonscully.com/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

/*
Gravity Forms Save Between Pages Add-On is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Gravity Forms Save Between Pages Add-On is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Gravity Forms Save Between Pages Add-On. If not, see {License URI}.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-gravityforms-save-between-pages.php' );
require_once( 'includes/class-gravityforms-save-between-pages-api.php' );

/**
 * Returns the main instance of GravityForms_Save_Between_Pages to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object GravityForms_Save_Between_Pages
 */
function GravityForms_Save_Between_Pages () {
	$instance = GravityForms_Save_Between_Pages::instance( __FILE__, '0.1.0' );
	return $instance;
}

GravityForms_Save_Between_Pages();