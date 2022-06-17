<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

/**
 * ald_user_booking option page view function
 *
 * @return page view
 */
function ald_user_booking_list(){
	$current_user = wp_get_current_user();
        if(isset($_GET['message']) ){
            if( $_GET['message'] = 'true'){
                ?>
                    <div id="message" class="updated notice notice-success is-dismissible"><p><?php echo __( 'Saved successfully.', 'ald_user_booking' ); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo __( "Dismiss this notice.", 'ald_user_booking' ); ?></span></button></div>
                <?php
            }
            else if( $_GET['message']= 'false'){
                ?>
                    <div id="message" class="updated notice notice-error is-dismissible"><p><?php echo __( "Sorry. Key didn't Save. Please try again later.", 'ald_user_booking' ); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo __( "Dismiss this notice.", 'ald_user_booking' ); ?></span></button></div>
                <?php
            }
        }
    ?>
	<br>
	<?php 
    if ( current_user_can('manage_options')){
        $bookingListTable = new Booking_List_Table();
        echo '<div class="wrap"><h2>'.__( 'Booking List', 'ald_user_booking' ).'</h2>';
        
        $bookingListTable->prepare_items();
        ?>
        <form method="post">
                <input type="hidden" name="page" value="employees_list_table" />
                <?php $bookingListTable->search_box('search', 'search_id'); ?>
        </form>
        <?php
		$bookingListTable->display();
        
        echo '</div>';
	}
}