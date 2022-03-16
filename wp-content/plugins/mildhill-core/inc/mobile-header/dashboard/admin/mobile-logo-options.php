<?php

if ( ! function_exists( 'mildhill_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add mobile header options for this module
	 */
	function mildhill_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {

			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'mildhill-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'mildhill-core' )
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'mildhill-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'mildhill-core' ),
					'args'        => array(
						'suffix' => 'px'
					)
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_main',
					'title'         => esc_html__( 'Mobile Logo - Main', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose main mobile logo image', 'mildhill-core' ),
					'default_value' => defined( 'MILDHILL_ASSETS_ROOT' ) ? MILDHILL_ASSETS_ROOT . '/img/logo-main.png' : '',
					'multiple'      => 'no'
				)
			);

			do_action( 'mildhill_core_action_after_mobile_logo_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_after_header_logo_options_map', 'mildhill_core_add_mobile_logo_options', 10, 2 );
}