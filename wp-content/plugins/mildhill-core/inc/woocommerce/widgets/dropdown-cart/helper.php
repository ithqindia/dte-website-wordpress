<?php

if ( ! function_exists( 'mildhill_core_get_cart_dropdown_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function mildhill_core_get_cart_dropdown_icon_html() {
		$html = '';

		$icon_source         = mildhill_core_get_option_value( 'admin', 'qodef_cart_dropdown_icon_source' );
		$icon_pack           = mildhill_core_get_option_value( 'admin', 'qodef_cart_dropdown_icon_pack' );
		$icon_svg_path       = mildhill_core_get_option_value( 'admin', 'qodef_cart_dropdown_icon_svg_path' );
		$close_icon_svg_path = mildhill_core_get_option_value( 'admin', 'qodef_cart_dropdown_close_icon_svg_path' );

		if ( $icon_source === 'icon_pack' && ! empty( $icon_pack ) ) {
			$html .= qode_framework_icons()->get_specific_icon_from_pack( 'dropdown-cart', $icon_pack );
		} else if ( $icon_source === 'svg_path' && ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) ) {
			$html .= $icon_svg_path;
		} else if ( $icon_source === 'predefined' ) {
			$html .= mildhill_core_get_svg( 'dropdown-cart' );
		}

		return $html;
	}
}