<?php

if ( ! function_exists( 'mildhill_core_add_icon_with_text_variation_before_content' ) ) {
	function mildhill_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_icon_with_text_layouts', 'mildhill_core_add_icon_with_text_variation_before_content' );
}
