<?php
/*
 * Plugin Name: Gravity Forms Save Between Pages
 * Version: 1.0
 * Plugin URI: http://branchdigital.com.au/
 * Description: Progressively save user the entries on multi-page forms between each page
 * Author: Shanon Scully
 * Author URI: http://shanonscully.com/
 * Requires at least: 4.2.2
 * Tested up to: 4.2.2
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