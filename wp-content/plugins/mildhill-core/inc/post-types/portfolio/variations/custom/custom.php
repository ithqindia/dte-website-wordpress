<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_variation_custom' ) ) {
	function mildhill_core_add_portfolio_single_variation_custom( $variations ) {
		$variations['custom'] = esc_html__( 'Custom', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_single_layout_options', 'mildhill_core_add_portfolio_single_variation_custom' );
}