<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

/**
 * ald_user_booking option page view function
 *
 * @return page view
 */
function ald_user_booking_list(){
	$current_user = wp_get_current_user();
	?>
	<div class="wrap">
	<span class="alignleft"><h1><?php echo __( 'Booking List', 'ald_user_booking' ); ?></h1></span>
  <span class="alignright"><h2><?php echo __( 'Welcome', 'ald_user_booking' ); ?>, <?php echo $current_user->display_name; ?> </h2></span>
  <?php
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
        ?>
        <form method="post">
        <?php
        $bookingListTable->prepare_items();
        $bookingListTable->search_box('Search', 'search');
		$bookingListTable->display();
        ?>
        </form>
        <?php
	}
}