<?php
if ( ! function_exists( 'mildhill_core_add_top_area_meta_options' ) ) {
	function mildhill_core_add_top_area_meta_options( $page ) {
		$top_area_section = $page->add_section_element(
			array(
				'name'       => 'qodef_top_area_section',
				'title'      => esc_html__( 'Top Area', 'mildhill-core' ),
				'dependency' => array(
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
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header',
				'title'       => esc_html__( 'Top Area', 'mildhill-core' ),
				'description' => esc_html__( 'Enable Top Area', 'mildhill-core' ),
				'options'     => mildhill_core_get_select_type_options_pool( 'yes_no' )
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
				'field_type'  => 'select',
				'name'        => 'qodef_set_top_area_header_in_grid',
				'title'       => esc_html__( 'Top Area In Grid', 'mildhill-core' ),
				'description' => esc_html__( 'Enabling this option will set page top area to be in grid', 'mildhill-core' ),
				'options'     => mildhill_core_get_select_type_options_pool( 'no_yes' )
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
	}

	add_action( 'mildhill_core_action_after_page_header_meta_map', 'mildhill_core_add_top_area_meta_options' );
}