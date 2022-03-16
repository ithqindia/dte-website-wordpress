<?php

if ( ! function_exists( 'mildhill_core_add_pricing_table_variation_standard' ) ) {
	function mildhill_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_pricing_table_layouts', 'mildhill_core_add_pricing_table_variation_standard' );
}