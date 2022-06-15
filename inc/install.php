<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.



define( 'ALD_USER_BOOKING_TABLE', $wpdb->prefix .'ald_user_booking' );
define( 'ALD_USER_TABLE', $wpdb->prefix .'users' );

function ald_user_booking_create_table(){
    global $wpdb;
    $charset_collate1 = $wpdb->get_charset_collate();
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    $user_table = $wpdb->prefix .'users';

    $user_booking_table = "CREATE TABLE IF NOT EXISTS $ald_user_booking_table(
		id bigint(20) NOT NULL AUTO_INCREMENT,
		booking_date datetime NOT NULL,
		user_id bigint(20) UNSIGNED NOT NULL,
        booking_quantity mediumint(2) NOT NULL,
        note tinytext NOT NULL,
        feedback tinytext NOT NULL,
        created_at datetime NOT NULL,
        updated_at datetime NOT NULL,
		PRIMARY KEY (id),
        FOREIGN KEY  (user_id) REFERENCES $user_table(id)
	)$charset_collate1;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($user_booking_table);
}

if (isset($_GET['activate']) && $_GET['activate'] == 'true'){
	add_action('init', 'ald_user_booking_create_table');
}