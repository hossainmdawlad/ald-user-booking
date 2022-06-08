<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

/**
 *  Admin Menu function to add admin menu item
 *
 * @return admin menu item to add with an wp action
 */
function ald_user_booking_plugin_menu() {
	add_menu_page(
			__( 'Booking', 'ald_user_booking' ),
			__( 'Booking', 'ald_user_booking' ),
			'manage_options',
			'ald_user_booking',
			'ald_user_booking_index',
			'dashicons-admin-network',
			6
		);
}
add_action('admin_menu', 'ald_user_booking_plugin_menu');