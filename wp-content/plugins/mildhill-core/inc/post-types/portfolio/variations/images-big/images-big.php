<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_variation_images_big' ) ) {
	function mildhill_core_add_portfolio_single_variation_images_big( $variations ) {
		
		$variations['images-big'] = esc_html__( 'Images - Big', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_single_layout_options', 'mildhill_core_add_portfolio_single_variation_images_big' );
}