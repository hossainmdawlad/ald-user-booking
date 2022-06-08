<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

/**
 * Client-end enqueue function
 *
 * @return void
 */
function ald_user_booking_scripts_js() {
    wp_enqueue_style( 'ald_user_booking-styles', ALD_USER_BOOKING_ASSETS_URL . '/css/style.bundle.css',array(), $plugin_data['Version'],'all' );
    wp_enqueue_script( 'ald-user-booking-script', ALD_USER_BOOKING_ASSETS_URL .'/js/scripts.bundle.js', array(), null, true );
    // wp_localize_script( 'ald_user_booking-script', 'ald_user_bookingAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
}
add_action( 'wp_enqueue_scripts', 'ald_user_booking_scripts_js' );

/**
 * Admin-end enqueue function
 *
 * @return void
 */
// function ald_user_booking_enqueue_admin_scripts() {
//     wp_enqueue_script( 'ald_user_booking-admin-script', ALD_USER_BOOKING_ASSETS_URL .'/admin/admin.min.js', array('jquery'), null, true );
// }
// add_action( 'admin_enqueue_scripts', 'ald_user_booking_enqueue_admin_scripts' );