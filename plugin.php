<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Croissant Polls
 * Description:       Add the polls custom post type
 * Version:           1.0.0
 * Author:            Shortlist Media
 * Author URI:        http://shortlistmedia.co.uk/
 * License:           MIT
 */

defined( 'ABSPATH' ) or die( ':)' );

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

add_action( 'plugins_loaded', function() {
	$container = require __DIR__ . '/container.php';

	$container['post_type']->init();
	$container['custom_fields']->register();
} );
