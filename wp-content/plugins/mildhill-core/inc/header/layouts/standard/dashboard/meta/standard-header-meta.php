<?php

if ( ! function_exists( 'mildhill_core_add_standard_header_meta' ) ) {
	function mildhill_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'mildhill-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'mildhill-core' ),
				'default_value' => '',
				'options'       => mildhill_core_get_select_type_options_pool( 'no_yes' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'mildhill-core' ),
				'description' => esc_html__( 'Enter header height', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'mildhill-core' ),
				'description' => esc_html__( 'Enter header background color', 'mildhill-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'mildhill-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'mildhill-core' ),
					'left'   => esc_html__( 'Left', 'mildhill-core' ),
					'center' => esc_html__( 'Center', 'mildhill-core' ),
					'right'  => esc_html__( 'Right', 'mildhill-core' ),
				)
			)
		);

	}

	add_action( 'mildhill_core_action_after_page_header_meta_map', 'mildhill_core_add_standard_header_meta' );
}