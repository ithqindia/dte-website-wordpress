<?php
/**
 * WooCommerce Coming Soon Product Page Functions
 *
 * Functions related to product pages.
 *
 * @author   Terry Tsang
 * @category Core
 * @package  WooCommerce Coming Soon Product/Functions
 * @version  1.0.0
 */

function wc_coming_soon_product_change_stock_status_label( $availability, $_product ) {
	global $post;

	// First check that if we have stock.
	if ( !$_product->is_in_stock() ) {

		// Change the label text "Out of Stock" to "'Coming Soon".
		$set_coming_soon   			= get_post_meta( $post->ID, '_set_coming_soon', true );
		$coming_soon_label 			= get_post_meta( $post->ID, '_coming_soon_label', true );
		
		if ( !empty( $set_coming_soon ) && $set_coming_soon == 'yes' ) {
			if ( !empty( $coming_soon_label ) ) {
				$availability['availability'] = $coming_soon_label;
			} else {
				$availability['availability'] = __( 'Coming Soon', 'wc-coming-soon-product' );
			}
			
			$availability['class'] = 'out-of-stock coming-soon';
		}
	}



	return $availability;
}


function wc_coming_soon_product_get_countdown_timer() {
	global $post;
	$product_id = $post->ID;	
	$product = wc_get_product( $product_id );
	$content = '';

	if ( !$product->is_in_stock() ) {
		$set_coming_soon   			= get_post_meta( $post->ID, '_set_coming_soon', true );
		$coming_soon_countdown 		= get_post_meta( $post->ID, '_coming_soon_countdown', true );
		$coming_soon_countdown_date = get_post_meta( $post->ID, '_coming_soon_countdown_date', true );

		if ( !empty( $set_coming_soon ) && $set_coming_soon == 'yes' && !empty( $coming_soon_countdown ) && $coming_soon_countdown == 'yes' && $coming_soon_countdown_date > date('Y-m-d')) {
			$content = 
				'<div id="clockdiv">
				  <div>
				    <span class="days"></span>
				    <div class="smalltext">Days</div>
				  </div>
				  <div>
				    <span class="hours"></span>
				    <div class="smalltext">Hours</div>
				  </div>
				  <div>
				    <span class="minutes"></span>
				    <div class="smalltext">Minutes</div>
				  </div>
				  <div>
				    <span class="seconds"></span>
				    <div class="smalltext">Seconds</div>
				  </div>
				</div>
				<script type="text/javascript">
					(function( $ ) {
						\'use strict\';
						$(function() {
							function getTimeRemaining(endtime) {
							  var t = Date.parse(endtime) - Date.parse(new Date());
							  var seconds = Math.floor((t / 1000) % 60);
							  var minutes = Math.floor((t / 1000 / 60) % 60);
							  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
							  var days = Math.floor(t / (1000 * 60 * 60 * 24));

							  return {
							    \'total\': t,
							    \'days\': days,
							    \'hours\': hours,
							    \'minutes\': minutes,
							    \'seconds\': seconds
							  };
							}

							function initializeClock(id, endtime) {
							  var clock = document.getElementById(id);
							  var daysSpan = clock.querySelector(\'.days\');
							  var hoursSpan = clock.querySelector(\'.hours\');
							  var minutesSpan = clock.querySelector(\'.minutes\');
							  var secondsSpan = clock.querySelector(\'.seconds\');

							  function updateClock() {
							    var t = getTimeRemaining(endtime);

							    daysSpan.innerHTML = t.days;
							    hoursSpan.innerHTML = (\'0\' + t.hours).slice(-2);
							    minutesSpan.innerHTML = (\'0\' + t.minutes).slice(-2);
							    secondsSpan.innerHTML = (\'0\' + t.seconds).slice(-2);

							    if (t.total <= 0) {
							      clearInterval(timeinterval);
							    }
							  }

							  updateClock();
							  var timeinterval = setInterval(updateClock, 1000);
							}

							var deadline = new Date("'.$coming_soon_countdown_date.'");
							initializeClock("clockdiv", deadline);
						});

					})( jQuery );
				</script>
				';
		}
	}

	echo $content;
}

function wc_coming_soon_product_get_link_url() {
	global $post;
	$product_id = $post->ID;	
	$product = wc_get_product( $product_id );
	$content 					= '';
	
	$set_coming_soon   			= get_post_meta( $post->ID, '_set_coming_soon', true );
	$coming_soon_link_text 		= get_post_meta( $post->ID, '_coming_soon_link_text', true );
	$coming_soon_link_url 		= get_post_meta( $post->ID, '_coming_soon_link_url', true );

	if ( !empty( $set_coming_soon ) && $set_coming_soon == 'yes' && !empty( $coming_soon_link_text ) &&  !empty( $coming_soon_link_url ) ) {
		$content = '<div style="padding:8px 0"><a href="'.$coming_soon_link_url.'" target="_blank">'.$coming_soon_link_text.'</a></div>';
	}

	echo $content;
}
