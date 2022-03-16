<?php

if ( ! function_exists( 'mildhill_core_get_fullscreen_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function mildhill_core_get_fullscreen_icon_html( $is_close_icon = false ) {
		$html = '';

		$icon_source         = mildhill_core_get_option_value( 'admin', 'qodef_fullscreen_menu_icon_source' );
		$icon_pack           = mildhill_core_get_option_value( 'admin', 'qodef_fullscreen_menu_icon_pack' );
		$icon_svg_path       = mildhill_core_get_option_value( 'admin', 'qodef_fullscreen_menu_icon_svg_path' );
		$close_icon_svg_path = mildhill_core_get_option_value( 'admin', 'qodef_fullscreen_menu_close_icon_svg_path' );

		if ( $icon_source === 'icon_pack' && ! empty( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack );
			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'menu', $icon_pack );
			}
		} else if ( $icon_source === 'svg_path' && ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) ) {
			if ( $is_close_icon ) {
				$html .= $close_icon_svg_path;
			} else {
				$html .= $icon_svg_path;
			}
		} else if ( $icon_source === 'predefined' ) {
			if ( $is_close_icon ) {
				$html .= mildhill_core_get_svg( 'close' );
			} else {
				$html .= mildhill_core_get_svg( 'menu' );
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'mildhill_core_register_fullscreen_menu' ) ) {
	function mildhill_core_register_fullscreen_menu( $menus ) {

		$menus['fullscreen-menu-navigation'] = esc_html__( 'Fullscreen Navigation', 'mildhill-core' );

		return $menus;
	}

	add_filter( 'mildhill_filter_register_navigation_menus', 'mildhill_core_register_fullscreen_menu' );
}

if ( ! function_exists( 'mildhill_core_fullscreen_menu_set_icon_styles' ) ) {
	/**
	 * Function that generates icon styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_fullscreen_menu_set_icon_styles( $style ) {
		$close_icon_style       = array();
		$close_icon_hover_style = array();

		$close_icon_color       = mildhill_core_get_option_value( 'admin', 'qodef_fullscreen_menu_close_icon_color' );
		$close_icon_hover_color = mildhill_core_get_option_value( 'admin', 'qodef_fullscreen_menu_close_icon_hover_color' );

		if ( ! empty( $close_icon_color ) ) {
			$close_icon_style['color'] = $close_icon_color;
		}

		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_style['color'] = $close_icon_hover_color;
		}

		if ( ! empty( $close_icon_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--minimal.qodef-fullscreen-menu--opened .qodef-fullscreen-menu-opener', $close_icon_style );
		}

		if ( ! empty( $close_icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--minimal.qodef-fullscreen-menu--opened .qodef-fullscreen-menu-opener:hover', $close_icon_hover_style );
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_fullscreen_menu_set_icon_styles' );
}