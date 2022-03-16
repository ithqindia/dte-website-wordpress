<?php

if ( ! function_exists( 'mildhill_core_add_image_with_text_variation_text_below' ) ) {
	function mildhill_core_add_image_with_text_variation_text_below( $variations ) {
		
		$variations['text-below'] = esc_html__( 'Text Below', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_image_with_text_layouts', 'mildhill_core_add_image_with_text_variation_text_below' );
}
