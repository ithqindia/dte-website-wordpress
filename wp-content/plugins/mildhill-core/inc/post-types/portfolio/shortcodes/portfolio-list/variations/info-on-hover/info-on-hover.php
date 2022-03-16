<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_list_variation_info_on_hover' ) ) {
	function mildhill_core_add_portfolio_list_variation_info_on_hover( $variations ) {
		
		$variations['info-on-hover'] = esc_html__( 'Info On Hover', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_list_layouts', 'mildhill_core_add_portfolio_list_variation_info_on_hover' );
}