<?php

if ( ! function_exists( 'mildhill_core_add_top_area_options' ) ) {
	function mildhill_core_add_top_area_options( $page ) {

		$top_area_section = $page->add_section_element(
			array(
				'name'        => 'qodef_top_area_section',
				'title'       => esc_html__( 'Top Area', 'mildhill-core' ),
				'description' => esc_html__( 'Options related to top area', 'mildhill-core' ),
				'dependency'  => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => mildhill_core_dependency_for_top_area_options(),
							'default_value' => ''
						)
					)
				)
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_top_area_header',
				'title'         => esc_html__( 'Top Area', 'mildhill-core' ),
				'description'   => esc_html__( 'Enable top area', 'mildhill-core' )
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'mildhill-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'mildhill-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_set_top_area_header_in_grid',
				'title'         => esc_html__( 'Top Area In Grid', 'mildhill-core' ),
				'description'   => esc_html__( 'Enabling this option will set page top area to be in grid', 'mildhill-core' ),
				'default_value' => 'no'
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'mildhill-core' ),
				'description' => esc_html__( 'Choose top area background color', 'mildhill-core' )
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'mildhill-core' ),
				'description' => esc_html__( 'Enter top area height (Default is 30px)', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'mildhill-core' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'mildhill-core' )
				)
			)
		);
	}

	add_action( 'mildhill_core_action_after_header_options_map', 'mildhill_core_add_top_area_options' );
}