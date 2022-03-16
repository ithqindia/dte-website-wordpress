<?php

if ( ! function_exists( 'mildhill_core_add_logo_options' ) ) {
	function mildhill_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'mildhill-core' ),
				'description' => esc_html__( 'Logo Settings', 'mildhill-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'mildhill-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'mildhill-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'mildhill-core' ),
					'description' => esc_html__( 'Enter logo height', 'mildhill-core' ),
					'args'        => array(
						'suffix' => 'px'
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_padding',
					'title'       => esc_html__( 'Logo Padding', 'mildhill-core' ),
					'description' => esc_html__( 'Enter logo padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' ),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_margin',
					'title'       => esc_html__( 'Logo Margin', 'mildhill-core' ),
					'description' => esc_html__( 'Enter logo margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' ),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'mildhill-core' ),
					'default_value' => defined( 'MILDHILL_ASSETS_ROOT' ) ? MILDHILL_ASSETS_ROOT . '/img/logo-main.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_dark',
					'title'         => esc_html__( 'Logo - Dark', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose dark logo image', 'mildhill-core' ),
					'default_value' => defined( 'MILDHILL_ASSETS_ROOT' ) ? MILDHILL_ASSETS_ROOT . '/img/logo-dark.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_light',
					'title'         => esc_html__( 'Logo - Light', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose light logo image', 'mildhill-core' ),
					'default_value' => defined( 'MILDHILL_ASSETS_ROOT' ) ? MILDHILL_ASSETS_ROOT . '/img/logo-light.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_sticky',
					'title'         => esc_html__( 'Logo - Sticky Header', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose sticky header logo image', 'mildhill-core' ),
					'default_value' => defined( 'MILDHILL_ASSETS_ROOT' ) ? MILDHILL_ASSETS_ROOT . '/img/logo-sticky.png' : '',
					'multiple'      => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_logo_options', mildhill_core_get_admin_options_map_position( 'logo' ) );
}