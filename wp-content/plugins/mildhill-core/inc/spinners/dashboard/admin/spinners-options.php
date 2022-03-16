<?php

if ( ! function_exists( 'mildhill_core_add_spinners_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_spinners_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_page_enable_loader',
					'title'         => esc_html__( 'Enable Page Loader', 'mildhill-core' ),
					'description'   => esc_html__( 'Enable Page Loader Effect', 'mildhill-core' ),
					'default_value' => 'no'
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_spinners',
					'title'       => esc_html__( 'Select Page Spinner Effect', 'mildhill-core' ),
					'description' => esc_html__( 'Choose a loader spinner animation style', 'mildhill-core' ),
					'options'     => array(
						''       				=> esc_html__( 'Default', 'mildhill-core' ),
						'mildhill_spinner'      => esc_html__( 'Mildhill Spinner', 'mildhill-core' ),
						'rotate_circles'        => esc_html__( 'Rotate Circles', 'mildhill-core' ),
						'pulse'                 => esc_html__( 'Pulse', 'mildhill-core' ),
						'double_pulse'          => esc_html__( 'Double Pulse', 'mildhill-core' ),
						'cube'                  => esc_html__( 'Cube', 'mildhill-core' ),
						'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'mildhill-core' ),
						'stripes'               => esc_html__( 'Stripes', 'mildhill-core' ),
						'wave'                  => esc_html__( 'Wave', 'mildhill-core' ),
						'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'mildhill-core' ),
						'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'mildhill-core' ),
						'atom'                  => esc_html__( 'Atom', 'mildhill-core' ),
						'clock'                 => esc_html__( 'Clock', 'mildhill-core' ),
						'mitosis'               => esc_html__( 'Mitosis', 'mildhill-core' ),
						'lines'                 => esc_html__( 'Lines', 'mildhill-core' ),
						'fussion'               => esc_html__( 'Fussion', 'mildhill-core' ),
						'wave_circles'          => esc_html__( 'Wave Circles', 'mildhill-core' ),
						'pulse_circles'         => esc_html__( 'Pulse Circles', 'mildhill-core' )
					),
					'dependency' => array(
						'hide' => array(
							'qodef_page_enable_loader' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'mildhill-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'mildhill-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_page_enable_loader' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'mildhill-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'mildhill-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_page_enable_loader' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
		}
	}
	
	add_action( 'mildhill_core_action_after_general_options_map', 'mildhill_core_add_spinners_options' );
	add_action( 'mildhill_core_action_after_general_page_meta_box_map', 'mildhill_core_add_spinners_options', 9 );
}