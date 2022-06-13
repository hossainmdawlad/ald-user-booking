<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Disallow direct HTTP access.

/**
 * ald_user_booking option page view function
 *
 * @return page view
 */
function ald_user_booking_index(){
	$current_user = wp_get_current_user();
	?>
	<div class="wrap">
	<span class="alignleft"><h1><?php echo __( 'User Booking', 'ald_user_booking' ); ?></h1></span>
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
	?>
	<form action="<?php echo admin_url( 'admin.php' ); ?>" method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php echo __( 'Email Recipient', 'ald_user_booking' ); ?></th>
					<td>
						<table class="form-table" id="repeatable-recipientEmail">
							<tbody>
								<?php 
								if (get_option( 'ald_user_booking_recipientemail' )) {
									foreach (get_option( 'ald_user_booking_recipientemail' ) as $key => $m_email) {
										?>
									<tr>
										<td>	
											<input type="email" name="recipientEmail[]" placeholder="<?php echo __( 'Email Recipient', 'ald_user_booking' ); ?>" class="regular-text" value="<?php echo $m_email; ?>" required />
										</td>
										<td><a class="button remove-recipientEmail" href="#">Remove</a></td>
									</tr>
								<?php
									}
								}else {
								?>
									<tr>
										<td>
											<input type="email" name="recipientEmail[]" placeholder="<?php echo __( 'Email Recipient', 'ald_user_booking' ); ?>" class="regular-text" value="" required />
										</td>
										<td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
									</tr>
								<?php
								}
								?>
								
								<tr class="empty-row-recipientEmail screen-reader-text">
									<td>
										<input type="email" name="recipientEmail[]" placeholder="<?php echo __( 'Email Recipient', 'ald_user_booking' ); ?>" class="regular-text" value="" />
									</td>
									<td><a class="button remove-recipientEmail" href="#">Remove</a></td>
								</tr>
							</tbody>
						</table>
						<p><a id="add-recipientEmail" class="button" href="#">Add another</a></p>
					</td>
				</tr>
				
				<tr>
					<th scope="row"><?php echo __( 'Sender Name', 'ald_user_booking' ); ?></th>
					<td>	
						<input type="text" name="senderName" placeholder="<?php echo __( 'Sender Name', 'ald_user_booking' ); ?>" class="regular-text" value="<?php echo (get_option( 'ald_user_booking_senderName' )) ? get_option( 'ald_user_booking_senderName' ):'' ; ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo __( 'Sender Email', 'ald_user_booking' ); ?></th>
					<td>	
						<input type="email" name="senderEmail" placeholder="<?php echo __( 'Sender Email', 'ald_user_booking' ); ?>" class="regular-text" value="<?php echo (get_option( 'ald_user_booking_senderEmail' )) ? get_option( 'ald_user_booking_senderEmail' ):'' ; ?>" />
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="action" value="save_ald_user_booking_option" />
		<input type="submit" value="<?php echo __( 'Save', 'ald_user_booking' ); ?>" class="button button-primary" />
	</form>
	<?php
	}
}