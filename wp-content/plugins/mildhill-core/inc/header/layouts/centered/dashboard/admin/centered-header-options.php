<?php

if ( ! function_exists( 'mildhill_core_add_centered_header_options' ) ) {
	function mildhill_core_add_centered_header_options( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_centered_header_section',
				'title'      => esc_html__( 'Centered Header', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'centered',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_centered_header_height',
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
				'name'        => 'qodef_centered_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'mildhill-core' ),
				'description' => esc_html__( 'Enter header background color', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_centered_header_in_grid',
				'title'         => esc_html__( 'Header Content in Grid', 'mildhill-core' ),
				'description'   => esc_html__( 'Set header content to be in grid', 'mildhill-core' ),
				'default_value' => 'no',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_centered_header_grid_background_color',
				'title'       => esc_html__( 'Header Grid Background Color', 'mildhill-core' ),
				'description' => esc_html__( 'Enter header grid background color', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				),
				'dependency'  => array(
					'show' => array(
						'qodef_centered_header_in_grid' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			)
		);
	}

	add_action( 'mildhill_core_action_after_header_options_map', 'mildhill_core_add_centered_header_options' );
}