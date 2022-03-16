<?php

if ( ! function_exists( 'mildhill_core_is_yith_product_sales_countdown_installed' ) ) {
	/**
	 * Function that check if sales countdown plugin is installed
	 *
	 * @return bool
	 */
	function mildhill_core_is_yith_product_sales_countdown_installed() {
		return defined( 'YWPC_INIT' );
	}
}

if ( ! function_exists( 'mildhill_core_woo_get_yith_countdown_on_list' ) ) {
	/**
	 * Function that add countdown on list
	 */
	function mildhill_core_woo_get_yith_countdown_on_list() {
		if ( mildhill_core_is_yith_product_sales_countdown_installed() ) {
			echo YITH_WPC()->add_ywpc_category();
		}
	}

	add_action( 'mildhill_core_action_woo_yith_countdown_on_list', 'mildhill_core_woo_get_yith_countdown_on_list' );
}

if ( ! function_exists( 'mildhill_core_woo_get_yith_countdown_on_single' ) ) {
	/**
	 * Function that add countdown on single
	 */
	function mildhill_core_woo_get_yith_countdown_on_single() {
		if ( mildhill_core_is_yith_product_sales_countdown_installed() ) {
			echo YITH_WPC()->add_ywpc_product();
		}
	}

	add_action( 'woocommerce_single_product_summary', 'mildhill_core_woo_get_yith_countdown_on_single', 4 ); // priority 4 is set because mildhill_core_woo_template_single_title hook is set on 5
}