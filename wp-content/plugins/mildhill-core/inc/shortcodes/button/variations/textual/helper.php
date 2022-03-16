<?php

if ( ! function_exists( 'mildhill_core_add_button_variation_textual' ) ) {
	function mildhill_core_add_button_variation_textual( $variations ) {
		
		$variations['textual'] = esc_html__( 'Textual', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_button_layouts', 'mildhill_core_add_button_variation_textual' );
}
