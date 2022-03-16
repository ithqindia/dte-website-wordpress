<?php

if ( ! function_exists( 'mildhill_core_add_blog_list_variation_standard' ) ) {
	function mildhill_core_add_blog_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_blog_list_layouts', 'mildhill_core_add_blog_list_variation_standard' );
}

if ( ! function_exists( 'mildhill_core_load_blog_list_variation_standard_assets' ) ) {
	function mildhill_core_load_blog_list_variation_standard_assets( $is_enabled, $params ) {
		
		if ( $params['layout'] === 'standard' ) {
			$is_enabled = true;
		}
		
		return $is_enabled;
	}
	
	add_filter( 'mildhill_core_filter_load_blog_list_assets', 'mildhill_core_load_blog_list_variation_standard_assets', 10, 2 );
}