<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

function store_user_booking()
{
    try {
        global $wpdb;
		$ald_user_booking_table = ALD_USER_BOOKING_TABLE;
        // $submitted_dates = explode(',',$_POST['submitted_date']);
        // $submitted_dates = date('d/m/Y H:i:s', ($_POST['submitted_date']/1000));
        date_default_timezone_set(wp_timezone_string());
        $submitted_dates = date('Y-m-d', ($_POST['submitted_date']/1000));
        $booking_date_submit_check = $wpdb->get_results("SELECT id FROM $ald_user_booking_table WHERE 
            (booking_date = '".$submitted_dates."' AND user_id = '". get_current_user_id() ."')", ARRAY_A);
            print_r($booking_date_submit_check[0]);
        if (empty( (array)$booking_date_submit_check[0] ) ) {
            $booking_date_submit_query = $wpdb->insert(
                $ald_user_booking_table,
                array(
                    'booking_date' => $submitted_dates,
                    'user_id' => get_current_user_id(),
                    'booking_quantity' => 1,
                    'note' => '',
                    'created_at' => gmdate('Y-m-d H:i:s'),
                    'updated_at' => gmdate('Y-m-d H:i:s'),
                )
            );
            wp_send_json( 'insert' );
            
        }else {
            $id = $booking_date_submit_check[0]['id'];
            // print_r($ids);
            $booking_date_submit_query = $wpdb->delete(
                $ald_user_booking_table,  
                array(
                    'id' => $id
                )
            );
            wp_send_json( 'delete' );
        }
        // foreach ($submitted_dates as $key => $submitted_date) {
        //     $booking_date = DateTime::createFromFormat('d/m/Y', $submitted_date)->format('Y-m-d');
            
        //     $booking_date_submit_check = $wpdb->get_results
        //     ("SELECT id FROM $ald_user_booking_table WHERE 
        //     (booking_date = '".$booking_date."' AND user_id = '". get_current_user_id() ."')");
        //     if ($booking_date_submit_check == false) {
        //         $booking_date_submit_query = $wpdb->insert(
        //             $ald_user_booking_table,
        //             array(
        //                 'booking_date' => $booking_date,
        //                 'user_id' => get_current_user_id(),
        //                 'booking_quantity' => 1,
        //                 'note' => '',
        //                 'created_at' => gmdate('Y-m-d H:i:s'),
        //                 'updated_at' => gmdate('Y-m-d H:i:s'),
        //             )
        //         );
        //         print_r($booking_date_submit_query);
        //     }else {
        //         # code...
        //     }
            
            
        // }
		
		
    } catch (\Throwable $th) {
        throw $th;
    }
    
    wp_die();
}
add_action('wp_ajax_store_user_booking','store_user_booking');
add_action('wp_ajax_nopriv_store_user_booking','store_user_booking');