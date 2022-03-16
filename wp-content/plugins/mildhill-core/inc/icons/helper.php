<?php

if ( ! function_exists( 'mildhill_core_include_icons' ) ) {
	/**
	 * Function that includes icons
	 */
	function mildhill_core_include_icons() {

		foreach ( glob( MILDHILL_CORE_INC_PATH . '/icons/*/include.php' ) as $icon_pack ) {
			$is_disabled = mildhill_core_performance_get_option_value( dirname( $icon_pack ), 'mildhill_core_performance_icon_pack_' );

			if ( empty( $is_disabled ) ) {
				include_once $icon_pack;
			}
		}
	}

	add_action( 'qode_framework_action_before_icons_register', 'mildhill_core_include_icons' );
}