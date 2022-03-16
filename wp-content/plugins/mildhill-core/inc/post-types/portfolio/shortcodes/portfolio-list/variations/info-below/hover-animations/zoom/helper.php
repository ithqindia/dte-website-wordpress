<?php

if ( ! function_exists( 'mildhill_core_filter_portfolio_list_info_below_zoom' ) ) {
	function mildhill_core_filter_portfolio_list_info_below_zoom( $variations ) {
		$variations['zoom'] = esc_html__( 'Zoom', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_list_info_below_animation_options', 'mildhill_core_filter_portfolio_list_info_below_zoom' );
}