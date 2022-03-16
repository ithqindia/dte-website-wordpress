<?php

if ( ! function_exists( 'mildhill_core_is_yith_wishlist_installed' ) ) {
	/**
	 * Function that check if wishlist plugin is installed
	 *
	 * @return bool
	 */
	function mildhill_core_is_yith_wishlist_installed() {
		return defined( 'YITH_WCWL' );
	}
}


if ( ! function_exists( 'mildhill_core_woo_get_yith_wishlist_shortcode' ) ) {
	/**
	 * Function that add wishlist shortcode
	 */
	function mildhill_core_woo_get_yith_wishlist_shortcode() {
		if ( mildhill_core_is_yith_wishlist_installed() ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}

	add_action( 'mildhill_core_action_woo_yith_buttons', 'mildhill_core_woo_get_yith_wishlist_shortcode', 2 );  // priority 1 is set because mildhill_core_woo_get_yith_quickview_link hook is set on 2
}