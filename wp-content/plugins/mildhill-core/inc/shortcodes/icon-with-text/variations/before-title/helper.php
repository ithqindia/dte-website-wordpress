<?php

if ( ! function_exists( 'mildhill_core_add_icon_with_text_variation_before_title' ) ) {
	function mildhill_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_icon_with_text_layouts', 'mildhill_core_add_icon_with_text_variation_before_title' );
}
