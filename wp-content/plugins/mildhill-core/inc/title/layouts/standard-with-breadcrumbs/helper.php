<?php

if ( ! function_exists( 'mildhill_core_register_standard_with_breadcrumbs_title_layout' ) ) {
	function mildhill_core_register_standard_with_breadcrumbs_title_layout( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = 'MildhillCoreStandardWithBreadcrumbsTitle';
		
		return $layouts;
	}
	
	add_filter( 'mildhill_core_filter_register_title_layouts', 'mildhill_core_register_standard_with_breadcrumbs_title_layout');
}

if ( ! function_exists( 'mildhill_core_add_standard_with_breadcrumbs_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function mildhill_core_add_standard_with_breadcrumbs_title_layout_option( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrums', 'mildhill-core' );
		
		return $layouts;
	}
	
	add_filter( 'mildhill_core_filter_title_layout_options', 'mildhill_core_add_standard_with_breadcrumbs_title_layout_option' );
}

