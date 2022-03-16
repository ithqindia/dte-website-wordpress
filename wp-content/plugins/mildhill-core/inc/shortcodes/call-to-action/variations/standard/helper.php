<?php

if ( ! function_exists( 'mildhill_core_add_call_to_action_variation_standard' ) ) {
	function mildhill_core_add_call_to_action_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_call_to_action_layouts', 'mildhill_core_add_call_to_action_variation_standard' );
}
