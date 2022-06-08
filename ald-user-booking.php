<?php
/*
Plugin Name: ALD User Booking
Plugin URI:
Description: ALD user booking plugin helps to create booking system internally in website
Author: Hossain Md. Awlad
Author URI:
Version: 1.0.0
License: GPLv2
Text Domain: ald_user_booking

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
*/
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.


if( ! function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$plugin_data = get_plugin_data( __FILE__ );
define( 'ALD_USER_BOOKING_VERSION', $plugin_data['Version'] );

/**
 * Define path
 */
define( "ALD_USER_BOOKING_MAIN_DIR", plugin_dir_path( __FILE__ ) );
define( 'ALD_USER_BOOKING_ASSETS_URL', plugins_url( '/assets', __FILE__ ) );

/**
 * Add all include files
 */
require_once ALD_USER_BOOKING_MAIN_DIR. '/inc/enqueue.php';
require_once ALD_USER_BOOKING_MAIN_DIR. '/inc/menu.php';
require_once ALD_USER_BOOKING_MAIN_DIR. '/inc/options.php';
require_once ALD_USER_BOOKING_MAIN_DIR. '/inc/shortcode.php';