<?php
if ( ! function_exists( 'mildhill_core_add_sticky_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function mildhill_core_add_sticky_header_option( $header_scroll_appearance_options ) {
		$header_scroll_appearance_options['sticky'] = esc_html__( 'Sticky', 'mildhill-core' );
		
		return $header_scroll_appearance_options;
	}
	
	add_filter( 'mildhill_core_filter_header_scroll_appearance_option', 'mildhill_core_add_sticky_header_option' );
}

if ( ! function_exists( 'mildhill_core_sticky_header_global_js_var' ) ) {
	function mildhill_core_sticky_header_global_js_var( $global_variables ) {
		$header_scroll_appearance = mildhill_core_get_post_value_through_levels( 'qodef_header_scroll_appearance' );
		
		if ( $header_scroll_appearance == 'sticky' ) {
			$sticky_scroll_amount_meta = mildhill_core_get_post_value_through_levels( 'qodef_sticky_header_scroll_amount' );
			$sticky_scroll_amount      = $sticky_scroll_amount_meta !== '' ? intval( $sticky_scroll_amount_meta ) : 0;
			
			$global_variables['qodefStickyHeaderScrollAmount'] = $sticky_scroll_amount;
		}
		
		return $global_variables;
	}
	
	add_filter( 'mildhill_filter_localize_main_js', 'mildhill_core_sticky_header_global_js_var' );
}

if ( ! function_exists( 'mildhill_core_register_sticky_header_areas' ) ) {
	/**
	 * Function that registers widget area for sticky header
	 */
	function mildhill_core_register_sticky_header_areas() {
		register_sidebar(
			array(
				'id'            => 'qodef-sticky-header-widget-area-one',
				'name'          => esc_html__( 'Sticky Header - Area One', 'mildhill-core' ),
				'description'   => esc_html__( 'Widgets added here will appear in sticky header widget area', 'mildhill-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-sticky-right">',
				'after_widget'  => '</div>'
			)
		);
	}
	
	add_action( 'mildhill_core_action_additional_header_widgets_area', 'mildhill_core_register_sticky_header_areas' );
}

if ( ! function_exists( 'mildhill_core_set_sticky_header_widget_area' ) ) {
	function mildhill_core_set_sticky_header_widget_area( $widget_area_map ) {
		
		if ( $widget_area_map['header_layout'] === 'sticky' ) {
			$widget_area_map['default_widget_area'] = 'qodef-sticky-header-widget-area-one';
			$widget_area_map['custom_widget_area']  = get_post_meta( $widget_area_map['page_id'], 'qodef_sticky_header_custom_widget_area_one', true );
		}
		
		return $widget_area_map;
	}
	
	add_filter( 'mildhill_core_filter_header_widget_area', 'mildhill_core_set_sticky_header_widget_area' );
}