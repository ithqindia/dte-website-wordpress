<?php

if ( ! function_exists( 'mildhill_core_add_social_share_variation_dropdown' ) ) {
	function mildhill_core_add_social_share_variation_dropdown( $variations ) {
		
		$variations['dropdown'] = esc_html__( 'Dropdown', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_social_share_layouts', 'mildhill_core_add_social_share_variation_dropdown' );
}
