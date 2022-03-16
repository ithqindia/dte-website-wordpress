<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_variation_gallery_big' ) ) {
	function mildhill_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_single_layout_options', 'mildhill_core_add_portfolio_single_variation_gallery_big' );
}