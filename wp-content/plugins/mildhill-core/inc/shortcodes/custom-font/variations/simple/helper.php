<?php

if ( ! function_exists( 'mildhill_core_add_custom_font_variation_simple' ) ) {
	function mildhill_core_add_custom_font_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_custom_font_layouts', 'mildhill_core_add_custom_font_variation_simple' );
}
