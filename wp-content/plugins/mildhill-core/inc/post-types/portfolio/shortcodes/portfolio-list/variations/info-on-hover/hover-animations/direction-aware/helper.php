<?php

if ( ! function_exists( 'mildhill_core_filter_portfolio_list_info_on_hover_direction_aware' ) ) {
	function mildhill_core_filter_portfolio_list_info_on_hover_direction_aware( $variations ) {
		$variations['direction-aware'] = esc_html__( 'Direction Aware', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_portfolio_list_info_on_hover_animation_options', 'mildhill_core_filter_portfolio_list_info_on_hover_direction_aware' );
}

if ( ! function_exists( 'mildhill_core_include_hoverdir_scripts' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts
	 *
	 * @param $atts
	 */
	function mildhill_core_include_hoverdir_scripts( $atts ) {
		
		if ( $atts['layout'] == 'info-on-hover' && $atts['hover_animation_info-on-hover'] == 'direction-aware' ) {
			wp_enqueue_script( 'hoverdir', MILDHILL_CORE_INC_URL_PATH . '/post-types/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/direction-aware/assets/js/plugins/jquery.hoverdir.min.js', array( 'jquery' ), true );
		}
	}
	
	add_action( 'mildhill_core_action_portfolio_list_load_assets', 'mildhill_core_include_hoverdir_scripts' );
}