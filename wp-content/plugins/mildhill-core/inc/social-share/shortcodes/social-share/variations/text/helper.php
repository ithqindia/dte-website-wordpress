<?php

if ( ! function_exists( 'mildhill_core_add_social_share_variation_text' ) ) {
	function mildhill_core_add_social_share_variation_text( $variations ) {
		
		$variations['text'] = esc_html__( 'Text', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_social_share_layouts', 'mildhill_core_add_social_share_variation_text' );
}
