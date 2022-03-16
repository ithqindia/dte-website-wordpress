<?php

if ( ! function_exists( 'mildhill_core_add_minimal_mobile_header_options' ) ) {
	function mildhill_core_add_minimal_mobile_header_options( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'mildhill-core' ),
				'description' => esc_html__( 'Enter header height', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'mildhill-core' ),
				'description' => esc_html__( 'Enter header background color', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'mildhill_core_action_after_mobile_header_options_map', 'mildhill_core_add_minimal_mobile_header_options' );
}