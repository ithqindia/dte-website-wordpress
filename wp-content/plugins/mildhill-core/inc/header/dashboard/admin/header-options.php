<?php

if ( ! function_exists( 'mildhill_core_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function mildhill_core_add_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'mildhill-core' ),
				'description' => esc_html__( 'Header Settings', 'mildhill-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose header layout to set for your site', 'mildhill-core' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'mildhill_core_filter_header_layout_option', $header_layout_options = array() ),
					'default_value' => apply_filters( 'mildhill_core_filter_header_layout_default_option_value', '' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'mildhill-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'mildhill-core' ),
					'options'     => array(
						'none'  => esc_html__( 'None', 'mildhill-core' ),
						'light' => esc_html__( 'Light', 'mildhill-core' ),
						'dark'  => esc_html__( 'Dark', 'mildhill-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_header_scroll_appearance',
					'title'         => esc_html__( 'Header Scroll Appearance', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose how header will act on scroll', 'mildhill-core' ),
					'options'       => apply_filters( 'mildhill_core_filter_header_scroll_appearance_option', $header_scroll_appearance_options = array( 'none' => esc_html__( 'None', 'mildhill-core' ) ) ),
					'default_value' => 'none'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_header_bottom_shadow',
					'title'         => esc_html__( 'Header Bottom Shadow', 'mildhill-core' ),
					'description'   => esc_html__( 'Enable header bottom shadow', 'mildhill-core' ),
					'default_value' => 'no',
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_header_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_header_options', mildhill_core_get_admin_options_map_position( 'header' ) );
}