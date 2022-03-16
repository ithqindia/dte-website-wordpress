<?php

if ( ! function_exists( 'mildhill_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Logo settings', 'mildhill-core' )
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'mildhill-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'mildhill-core' ),
					'description' => esc_html__( 'Enter Logo Height', 'mildhill-core' ),
					'args'        => array(
						'suffix' => 'px'
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_padding',
					'title'       => esc_html__( 'Logo Padding', 'mildhill-core' ),
					'description' => esc_html__( 'Enter logo padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_margin',
					'title'       => esc_html__( 'Logo Margin', 'mildhill-core' ),
					'description' => esc_html__( 'Enter logo margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'mildhill-core' ),
					'description' => esc_html__( 'Choose main logo image', 'mildhill-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'mildhill-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'mildhill-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'mildhill-core' ),
					'description' => esc_html__( 'Choose light logo image', 'mildhill-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky Header', 'mildhill-core' ),
					'description' => esc_html__( 'Choose sticky header logo image', 'mildhill-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_page_logo_meta_map', $logo_tab );
		}
	}

	add_action( 'mildhill_core_action_after_general_meta_box_map', 'mildhill_core_add_page_logo_meta_box' );
	add_action( 'mildhill_core_action_after_portfolio_meta_box_map', 'mildhill_core_add_page_logo_meta_box' );
}