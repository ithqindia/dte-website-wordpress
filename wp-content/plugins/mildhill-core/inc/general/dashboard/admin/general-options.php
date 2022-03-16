<?php

if ( ! function_exists( 'mildhill_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'mildhill-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'mildhill-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'mildhill-core' ),
					'description' => esc_html__( 'Set a background color for this website', 'mildhill-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'mildhill-core' ),
					'description' => esc_html__( 'Set Background Image for Website', 'mildhill-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Repeat', 'mildhill-core' ),
					'description' => esc_html__( 'Set Background Repeat for Website', 'mildhill-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'mildhill-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'mildhill-core' ),
						'repeat'    => esc_html__( 'Repeat', 'mildhill-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'mildhill-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'mildhill-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Size', 'mildhill-core' ),
					'description' => esc_html__( 'Set Background Size for Website', 'mildhill-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'mildhill-core' ),
						'contain' => esc_html__( 'Contain', 'mildhill-core' ),
						'cover'   => esc_html__( 'Cover', 'mildhill-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Attachment', 'mildhill-core' ),
					'description' => esc_html__( 'Set Background Attachment for Website', 'mildhill-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'mildhill-core' ),
						'fixed'  => esc_html__( 'Fixed', 'mildhill-core' ),
						'scroll' => esc_html__( 'Scroll', 'mildhill-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'mildhill-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'mildhill-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'mildhill-core' ),
					'description'   => esc_html__( 'Set Boxed Layout', 'mildhill-core' ),
					'default_value' => 'no'
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'mildhill-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'mildhill-core' ),
					'description' => esc_html__( 'Set Boxed Background Color', 'mildhill-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'mildhill-core' ),
					'options'       => mildhill_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100'
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'mildhill-core' ),
					'description' => esc_html__( 'Enter your custom Javascript here', 'mildhill-core' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_general_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_general_options', mildhill_core_get_admin_options_map_position( 'general' ) );
}