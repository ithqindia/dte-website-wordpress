<?php

include_once MILDHILL_CORE_INC_PATH . '/core-dashboard/core-dashboard.php';

if ( ! function_exists( 'mildhill_core_dashboard_load_files' ) ) {
	function mildhill_core_dashboard_load_files() {
		include_once MILDHILL_CORE_INC_PATH . '/core-dashboard/rest/include.php';
		include_once MILDHILL_CORE_INC_PATH . '/core-dashboard/registration-rest.php';
		include_once MILDHILL_CORE_INC_PATH . '/core-dashboard/sub-pages/sub-page.php';
		
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/core-dashboard/sub-pages/*/load.php' ) as $subpages ) {
			include_once $subpages;
		}
	}
	
	add_action( 'after_setup_theme', 'mildhill_core_dashboard_load_files' );
}