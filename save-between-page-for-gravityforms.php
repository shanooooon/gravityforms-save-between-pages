<?php

/*
Plugin Name: Save Between Pages for Gravity Forms Add-On
Plugin URI:  https://github.com/shanooooon/save-between-page-for-gravityforms
Description: Progressively save user the entries on multi-page Gravity Forms between each page
Version:     0.1.0
Author:      Shanon Scully
Author URI:  http://shanonscully.com/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

/*
Save Between Pages for Gravity Forms Add-On is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Save Between Pages for Gravity Forms Add-On is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Save Between Pages for Gravity Forms Add-On. If not, see {License URI}.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-save-between-page-for-gravityforms.php' );
require_once( 'includes/class-save-between-page-for-gravityforms-api.php' );

/**
 * Returns the main instance of Save_Between_Pages_for_GravityForms to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Save_Between_Pages_for_GravityForms
 */
function Save_Between_Pages_for_GravityForms () {
	$instance = Save_Between_Pages_for_GravityForms::instance( __FILE__, '0.1.0' );
	return $instance;
}

Save_Between_Pages_for_GravityForms();