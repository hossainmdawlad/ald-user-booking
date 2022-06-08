<?php
function ald_user_booking_func( $atts ){
	$output = '';
	$output .= '<div class="ald_user_booking">';
	$output .= sprintf('<div id="ald_user_booking-js-tabs">
					<nav class="js-tabs__nav">
						<ul class="js-tabs__tabs-container">
							<li class="js-tabs__tab active">My Booking</li>
							<li class="js-tabs__tab">Todays Booking</li>
							<li class="js-tabs__tab">Date wise Booking</li>
							<li class="js-tabs__tab">Tab 4</li>
						</ul>
						<div class="js-tabs__marker"></div>
					</nav>
				
					<ul class="js-tabs__content-container">
						<li class="js-tabs__content active">
							<div id="ald_user_booking" name="ald_user_booking"></div>
						</li>
						<li class="js-tabs__content">
							<div class="date_block"><strong class="date_today">Today</strong></div>
							<table>
								<thead>
									<tr>
										<td>Name</td>
										<td>Last Update</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>Total= 10</td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</li>
						<li class="js-tabs__content">
							<div class="date_block"><strong class="month_today">Month</strong></div>
							<input id="ald_user_booking_monthly" name="ald_user_booking_monthly">
							<table>
								<thead>
									<tr>
										<td>Name</td>
										<td>Last Update</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
									<tr>
										<td>Alfreds Futterkiste</td>
										<td>Jun 08 2022</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>Total= 10</td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</li>
						<li class="js-tabs__content">
							<p>Content 4</p>
						</li>
					</ul>
				</div>');

	$output .= '</div>';

	return $output;
}
// add_shortcode( 'ald_user_booking', 'ald_user_booking_func' );

function register_shortcodes(){
	add_shortcode( 'ald_user_booking', 'ald_user_booking_func' );
}
add_action('init', 'register_shortcodes');