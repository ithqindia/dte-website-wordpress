<?php

if ( ! function_exists( 'mildhill_core_add_button_variation_filled' ) ) {
	function mildhill_core_add_button_variation_filled( $variations ) {
		
		$variations['filled'] = esc_html__( 'Filled', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_button_layouts', 'mildhill_core_add_button_variation_filled' );
}
