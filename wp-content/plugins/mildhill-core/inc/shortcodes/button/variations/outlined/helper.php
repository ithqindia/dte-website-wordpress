<?php

if ( ! function_exists( 'mildhill_core_add_button_variation_outlined' ) ) {
	function mildhill_core_add_button_variation_outlined( $variations ) {
		
		$variations['outlined'] = esc_html__( 'Outlined', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_button_layouts', 'mildhill_core_add_button_variation_outlined' );
}
