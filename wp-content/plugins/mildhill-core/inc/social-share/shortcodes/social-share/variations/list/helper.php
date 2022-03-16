<?php

if ( ! function_exists( 'mildhill_core_add_social_share_variation_list' ) ) {
	function mildhill_core_add_social_share_variation_list( $variations ) {
		
		$variations['list'] = esc_html__( 'List', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_social_share_layouts', 'mildhill_core_add_social_share_variation_list' );
}
