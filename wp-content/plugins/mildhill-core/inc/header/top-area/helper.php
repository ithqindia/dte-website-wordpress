<?php
if ( ! function_exists( 'mildhill_core_dependency_for_top_area_options' ) ) {
	function mildhill_core_dependency_for_top_area_options() {
		$dependency_options = apply_filters( 'mildhill_core_filter_top_area_hide_option', $hide_dep_options = array() );

		return $dependency_options;
	}
}

if ( ! function_exists( 'mildhill_core_register_top_area_header_areas' ) ) {
	function mildhill_core_register_top_area_header_areas() {
		register_sidebar(
			array(
				'id'            => 'qodef-top-area-left',
				'name'          => esc_html__( 'Header Top Area - Left', 'mildhill-core' ),
				'description'   => esc_html__( 'Widgets added here will appear on the left side in top header area', 'mildhill-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-area-widget">',
				'after_widget'  => '</div>'
			)
		);

		register_sidebar(
			array(
				'id'            => 'qodef-top-area-right',
				'name'          => esc_html__( 'Header Top Area - Right', 'mildhill-core' ),
				'description'   => esc_html__( 'Widgets added here will appear on the right side in top header area', 'mildhill-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-area-widget">',
				'after_widget'  => '</div>'
			)
		);
	}

	add_action( 'mildhill_core_action_additional_header_widgets_area', 'mildhill_core_register_top_area_header_areas' );
}

if ( ! function_exists( 'mildhill_core_set_top_area_header_widget_area' ) ) {
	function mildhill_core_set_top_area_header_widget_area( $widget_area_map ) {

		if ( $widget_area_map['header_layout'] === 'top-area-left' ) {
			$widget_area_map['is_enabled']          = true;
			$widget_area_map['default_widget_area'] = 'qodef-top-area-left';
			$widget_area_map['custom_widget_area']  = '';
		} else if ( $widget_area_map['header_layout'] === 'top-area-right' ) {
			$widget_area_map['is_enabled']          = true;
			$widget_area_map['default_widget_area'] = 'qodef-top-area-right';
			$widget_area_map['custom_widget_area']  = '';
		}

		return $widget_area_map;
	}

	add_filter( 'mildhill_core_filter_header_widget_area', 'mildhill_core_set_top_area_header_widget_area' );
}

if ( ! function_exists( 'mildhill_core_set_top_area_classes' ) ) {
	/**
	 * Function that return classes for page top area
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_top_area_classes( $classes ) {
		$is_grid_enabled = mildhill_core_get_post_value_through_levels( 'qodef_set_top_area_header_in_grid' ) !== 'no';

		if ( ! $is_grid_enabled ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'mildhill_core_filter_top_area_classes', 'mildhill_core_set_top_area_classes' );
}

if ( ! function_exists( 'mildhill_core_get_top_area_classes' ) ) {
	/**
	 * Function that return classes for page top area
	 *
	 * @return string
	 */
	function mildhill_core_get_top_area_classes() {
		$classes = apply_filters( 'mildhill_core_filter_top_area_classes', 'qodef-content-grid' );

		return $classes;
	}
}