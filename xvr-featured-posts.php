<?php
/**
 * @package  AlecadddPlugin
 */
/*
Plugin Name: XVR Featured Posts
Plugin URI: http://zabiranik.me
Description: Featured posts with admin settings, shortcode for frontend.
Version: 1.0.0
Author: Zabir Anik
Author URI: http://zabiranik.me
License: GPLv2 or later
Text Domain: xvr-featured-posts
*/

defined( 'ABSPATH' ) or exit();

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_alecaddd_plugin() {
	XVR\Featured_Posts\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_alecaddd_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_alecaddd_plugin() {
	XVR\Featured_Posts\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_alecaddd_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'XVR\Featured_Posts\\Init' ) ) {
	XVR\Featured_Posts\Init::register_services();
}