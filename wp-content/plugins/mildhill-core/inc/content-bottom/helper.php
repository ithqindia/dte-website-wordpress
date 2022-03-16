<?php

if ( ! function_exists( 'mildhill_core_is_page_content_bottom_enabled' ) ) {
	/**
	 * function that check is module enabled
	 *
	 * @param $is_enabled bool
	 *
	 * @return bool
	 */
	function mildhill_core_is_page_content_bottom_enabled( $is_enabled ) {
		$option = mildhill_core_get_post_value_through_levels( 'qodef_enable_page_content_bottom' ) !== 'no';

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	add_filter( 'mildhill_core_filter_enable_page_content_bottom', 'mildhill_core_is_page_content_bottom_enabled' );
}

if ( ! function_exists( 'mildhill_core_set_content_bottom_area_classes' ) ) {
	/**
	 * function that return classes for page content bottom area
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_content_bottom_area_classes( $classes ) {
		$is_grid_enabled = mildhill_core_get_post_value_through_levels( 'qodef_set_content_bottom_area_in_grid' ) !== 'no';

		if ( ! $is_grid_enabled ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'mildhill_core_filter_content_bottom_area_classes', 'mildhill_core_set_content_bottom_area_classes' );
}

if ( ! function_exists( 'mildhill_core_filter_enable_page_content_bottom' ) ) {
	/**
	 * function that check is module enabled
	 */
	function mildhill_core_filter_enable_page_content_bottom() {
		$is_enabled = true;

		return apply_filters( 'mildhill_core_filter_enable_page_content_bottom', $is_enabled );
	}
}

if ( ! function_exists( 'mildhill_core_get_content_bottom_area_classes' ) ) {
	/**
	 * function that return classes for page content bottom area
	 *
	 * @return string
	 */
	function mildhill_core_get_content_bottom_area_classes() {
		$classes = apply_filters( 'mildhill_core_filter_content_bottom_area_classes', 'qodef-content-grid' );

		return $classes;
	}
}

if ( ! function_exists( 'mildhill_core_load_page_content_bottom' ) ) {
	/**
	 * function which loads page template module
	 */
	function mildhill_core_load_page_content_bottom() {
		if ( mildhill_core_filter_enable_page_content_bottom() ) {
			echo apply_filters( 'mildhill_core_filter_content_bottom_template', mildhill_core_get_template_part( 'content-bottom', 'templates/content-bottom' ) );
		}
	}

	add_action( 'mildhill_action_page_content_bottom_template', 'mildhill_core_load_page_content_bottom' );
}
