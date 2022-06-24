<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

function store_user_booking()
{
    if (is_user_logged_in()) {
        try {
            
            // $submitted_dates = explode(',',$_POST['submitted_date']);
            // $submitted_dates = date('d/m/Y H:i:s', ($_POST['submitted_date']/1000));
            date_default_timezone_set(wp_timezone_string());
            $submitted_dates = date('Y-m-d', strtotime($_POST['submitted_date']));
            // print_r($_POST['submitted_date']);
            // print_r('<br>');
            // print_r($submitted_dates);
            // wp_die();
            $booking_date_submit_check = get_single_booking(get_current_user_id(),$submitted_dates);

            
            if (empty( (array)$booking_date_submit_check[0] ) ) {
                booking_insert(get_current_user_id(),$submitted_dates);
                $message = __('Booking inserted','ald_user_booking');
                wp_send_json( $message );
                
            }else {
                $id = $booking_date_submit_check[0]['id'];
                // print_r($ids);
                booking_delete($id);
                $message = __('Booking removed','ald_user_booking');
                wp_send_json( $message );
            }
            
        } catch (\Throwable $th) {
            // throw $th;
            wp_send_json( $th );
    
        }
    }else{
        $message = __('You need to login for booking','ald_user_booking');
        wp_send_json( $message );
    }
    
    wp_die();
}
add_action('wp_ajax_store_user_booking','store_user_booking');
add_action('wp_ajax_nopriv_store_user_booking','store_user_booking');

function get_single_user_booking_dates()
{
    if (is_user_logged_in()) {
        try {
            $get_single_user_booking_dates = get_user_booking_dates(get_current_user_id());
            // print_r( $get_single_user_booking_dates );
            wp_send_json( $get_single_user_booking_dates );
        } catch (\Throwable $th) {
            // throw $th;
            wp_send_json( $th );
        }
    }else{
        $message = __('You need to login for booking','ald_user_booking');
        wp_send_json( $message );
    }
    
    wp_die();
}
add_action('wp_ajax_get_single_user_booking_dates','get_single_user_booking_dates');
add_action('wp_ajax_nopriv_get_single_user_booking_dates','get_single_user_booking_dates');

function todays_booking()
{
    if (is_user_logged_in()) {
        try {
            date_default_timezone_set(wp_timezone_string());
            $booking_date = date('Y-m-d');
            $get_todays_booking = get_todays_booking($booking_date);
            // print_r( $get_todays_booking );
            wp_send_json( $get_todays_booking );
        } catch (\Throwable $th) {
            // throw $th;
            wp_send_json( $th );
        }
    }else{
        $message = __('You need to login for booking','ald_user_booking');
        wp_send_json( $message );
    }
    
    wp_die();
}
add_action('wp_ajax_todays_booking','todays_booking');
add_action('wp_ajax_nopriv_todays_booking','todays_booking');

function get_todays_booking($booking_date){
    global $wpdb;
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    $user_table = ALD_USER_TABLE;
    // return $get_todays_booking = $wpdb->prepare("SELECT `user_id`,`updated_at` FROM $ald_user_booking_table WHERE 
    //              DATE(`booking_date`) = DATE(NOW())");
    return $get_todays_booking = $wpdb->get_results("SELECT $user_table.display_name,$ald_user_booking_table.`updated_at` FROM $ald_user_booking_table 
    INNER JOIN $user_table ON 
    $ald_user_booking_table.`user_id`=`$user_table`.`ID`
    WHERE 
    DATE($ald_user_booking_table.`booking_date`) = DATE(NOW()) ");
}

function get_user_booking_dates($user_id)
{
    global $wpdb;
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    return $booking_date_submit_check = $wpdb->get_col("SELECT booking_date FROM $ald_user_booking_table WHERE 
                ( user_id = '". $user_id ."')");
}

function get_single_booking($user_id, $submitted_dates){
    global $wpdb;
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    return $booking_date_submit_check = $wpdb->get_results("SELECT id FROM $ald_user_booking_table WHERE 
                (booking_date = '".$submitted_dates."' AND user_id = '". $user_id ."')", ARRAY_A);
}

function booking_insert($user_id, $submitted_dates, $note='',$feedback=''){
    global $wpdb;
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    return $booking_date_submit_query = $wpdb->insert(
        $ald_user_booking_table,
        array(
            'booking_date' => $submitted_dates,
            'user_id' => $user_id,
            'booking_quantity' => 1,
            'note' => $note,
            'feedback' => $feedback,
            'created_at' => gmdate('Y-m-d H:i:s'),
            'updated_at' => gmdate('Y-m-d H:i:s'),
        )
    );
            
}

function feedback_add($user_id,$date, $feedback=''){
    global $wpdb;
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    
    return $booking_date_submit_query = $wpdb->update(
        $ald_user_booking_table,
        array(
            'feedback' => $feedback,
            'updated_at' => gmdate('Y-m-d H:i:s'),
        ),
        array(
            'user_id' => $user_id,
            'booking_date' => $date
        )
    );
            
}

function booking_delete($id){
    global $wpdb;
    $ald_user_booking_table = ALD_USER_BOOKING_TABLE;
    return $booking_date_submit_query = $wpdb->delete(
        $ald_user_booking_table,  
        array(
            'id' => $id
        )
    );
}

function store_prev_feedback()
{
    if (is_user_logged_in()) {
        try {
            
            date_default_timezone_set(wp_timezone_string());
            $previous_day = date('Y-m-d',strtotime("-1 days"));
            $booking_date_submit_check = get_single_booking(get_current_user_id(),$previous_day);

            // print_r($booking_date_submit_check);
            // wp_die();
            
            if (!empty( (array)$booking_date_submit_check[0] ) ) {
                feedback_add(get_current_user_id(),$previous_day ,$_POST['prev_feedback']);
                $message = __('Feedback added','ald_user_booking');
                wp_send_json_success( $message, 200);
                
            }else {
                // $id = $booking_date_submit_check[0]['id'];
                // // print_r($ids);
                // booking_delete($id);
                $message = __('You didn\'t book yesterday.','ald_user_booking');
                wp_send_json( $message, 199 );
            }
            
        } catch (\Throwable $th) {
            // throw $th;
            wp_send_json_error( $th, 400 );
    
        }
    }else{
        $message = __('You need to login for booking','ald_user_booking');
        wp_send_json_error( $message, 403 );
    }
    
    wp_die();
}
add_action('wp_ajax_store_prev_feedback','store_prev_feedback');
add_action('wp_ajax_nopriv_store_prev_feedback','store_prev_feedback');