<?php

if ( ! function_exists( 'mildhill_core_is_yith_quickview_installed' ) ) {
	/**
	 * Function that check if quick view plugin is installed
	 *
	 * @return bool
	 */
	function mildhill_core_is_yith_quickview_installed() {
		return defined( 'YITH_WCQV_INIT' );
	}
}

if ( ! function_exists( 'mildhill_core_woo_get_yith_quickview_link' ) ) {
	/**
	 * Function that returns quick view link
	 */
	function mildhill_core_woo_get_yith_quickview_link() {
		if ( mildhill_core_is_yith_quickview_installed() ) {
			global $product;

			echo '<a href="#" class="button yith-wcqv-button" data-product_id="' . $product->get_id() . '"></a>';
		}
	}

	add_action( 'mildhill_core_action_woo_yith_buttons', 'mildhill_core_woo_get_yith_quickview_link', 1 ); // priority 1 is set because mildhill_core_woo_get_yith_wishlist_shortcode hook is set on 2
}