<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_variation_images_small' ) ) {
	function mildhill_core_add_portfolio_single_variation_images_small( $variations ) {
		
		$variations['images-small'] = esc_html__( 'Images - Small', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_single_layout_options', 'mildhill_core_add_portfolio_single_variation_images_small' );
}