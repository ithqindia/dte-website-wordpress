<?php

if ( ! function_exists( 'mildhill_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'mildhill-core' ),
				'description' => esc_html__( 'General page layout settings', 'mildhill-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'mildhill-core' ),
				'description' => esc_html__( 'Set a background color for this website', 'mildhill-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'mildhill-core' ),
				'description' => esc_html__( 'Set Background Image for Website', 'mildhill-core' )
			)
		);

		$general_tab->add_field_element(
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

		$general_tab->add_field_element(
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

		$general_tab->add_field_element(
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

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'mildhill-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'mildhill-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'mildhill-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'mildhill-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'mildhill-core' ),
				'options'     => mildhill_core_get_select_type_options_pool( 'content_width' )
			)
		);

		//boxed layout option
		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_boxed',
				'title'       => esc_html__( 'Boxed Layout', 'mildhill-core' ),
				'description' => esc_html__( 'Set Boxed Layout', 'mildhill-core' ),
				'options'     => mildhill_core_get_select_type_options_pool( 'no_yes' )
			)
		);

		$boxed_section = $general_tab->add_section_element(
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

		$general_tab->add_field_element( array(
			'field_type'    => 'yesno',
			'default_value' => 'no',
			'name'          => 'qodef_content_behind_header',
			'title'         => esc_html__( 'Always put content behind header', 'mildhill-core' ),
			'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'mildhill-core' ),
		) );

		$general_tab->add_field_element( array(
			'field_type'    => 'yesno',
			'default_value' => 'no',
			'name'          => 'qodef_enable_ripped_line_svg',
			'title'         => esc_html__( 'Enable Ripped Line SVG', 'mildhill-core' ),
			'description'   => esc_html__( 'Enabling this option will put ripped line effect before the page content', 'mildhill-core' )
		) );

		$general_tab->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_enable_map',
				'default_value' => 'no',
				'title'         => esc_html__( 'Enable map before content', 'mildhill-core' ),
				'description'   => esc_html__( 'Enabling this option will place a map before the page content', 'mildhill-core' ),
			)
		);

		$map_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_map_section',
				'title'      => esc_html__( 'Map Section', 'mildhill-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_enable_map' => array(
							'values'        => 'no',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$map_section->add_field_element( array(
			'field_type' => 'text',
			'name'       => 'qodef_map_address_1',
			'title'      => esc_html__( 'Map Address 1', 'mildhill-core' ),
		) );

		$map_section->add_field_element( array(
			'field_type' => 'text',
			'name'       => 'qodef_map_address_2',
			'title'      => esc_html__( 'Map Address 2', 'mildhill-core' ),
		) );

		$map_section->add_field_element( array(
			'field_type' => 'text',
			'name'       => 'qodef_map_address_3',
			'title'      => esc_html__( 'Map Address 3', 'mildhill-core' ),
		) );

		$map_section->add_field_element( array(
			'field_type' => 'text',
			'name'       => 'qodef_map_address_4',
			'title'      => esc_html__( 'Map Address 4', 'mildhill-core' ),
		) );

		$map_section->add_field_element( array(
			'field_type' => 'text',
			'name'       => 'qodef_map_height',
			'title'      => esc_html__( 'Map Height', 'mildhill-core' ),
		) );

		$map_section->add_field_element( array(
			'field_type' => 'image',
			'name'       => 'qodef_map_pin',
			'title'      => esc_html__( 'Map Pin', 'mildhill-core' ),
		) );


		// Hook to include additional options after module options
		do_action( 'mildhill_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'mildhill_core_action_after_general_meta_box_map', 'mildhill_core_add_general_page_meta_box', 9 );
	add_action( 'mildhill_core_action_after_portfolio_meta_box_map', 'mildhill_core_add_general_page_meta_box' );
}