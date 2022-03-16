<?php
if( isset( $media ) && ! empty( $media ) ) {
	$settings    = apply_filters( 'mildhill_core_filter_portfolio_video_format_settings', array(
		'width'  => 1100,
		'height' => 684,
		'loop'   => true
	) );
	
	echo wp_video_shortcode( array_merge( array( 'src' => esc_url( $media ) ), $settings ) );
}