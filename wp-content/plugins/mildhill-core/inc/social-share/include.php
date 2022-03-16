<?php

include_once 'helper.php';
include_once 'dashboard/admin/social-share-options.php';

if ( ! function_exists( 'mildhill_core_include_social_share_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function mildhill_core_include_social_share_shortcodes() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/social-share/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'mildhill_core_include_social_share_shortcodes' );
}

if ( ! function_exists( 'mildhill_core_include_social_share_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function mildhill_core_include_social_share_widgets() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/social-share/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'mildhill_core_include_social_share_widgets' );
}