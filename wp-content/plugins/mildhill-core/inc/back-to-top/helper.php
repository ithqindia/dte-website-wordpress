<?php

if ( ! function_exists( 'mildhill_core_is_back_to_top_enabled' ) ) {
	function mildhill_core_is_back_to_top_enabled() {
		return mildhill_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'mildhill_core_add_back_to_top_to_body_classes' ) ) {
	function mildhill_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = mildhill_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'mildhill_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'mildhill_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function mildhill_core_load_back_to_top() {
		
		if ( mildhill_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			mildhill_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'mildhill_action_before_wrapper_close_tag', 'mildhill_core_load_back_to_top' );
}