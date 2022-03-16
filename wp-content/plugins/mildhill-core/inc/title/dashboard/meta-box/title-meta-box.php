<?php

if ( ! function_exists( 'mildhill_core_add_page_title_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_page_title_meta_box( $page ) {

		if ( $page ) {

			$title_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-title',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Title Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Title layout settings', 'mildhill-core' )
				)
			);

			$title_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'mildhill-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section = $title_tab->add_section_element(
				array(
					'name'       => 'qodef_page_title_section',
					'title'      => esc_html__( 'Title Area', 'mildhill-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_title_layout',
					'title'       => esc_html__( 'Title Layout', 'mildhill-core' ),
					'description' => esc_html__( 'Choose title layout to set for your site', 'mildhill-core' ),
					'options'     => apply_filters( 'mildhill_core_filter_title_layout_options', $layouts = array( '' => esc_html__( 'Default', 'mildhill-core' ) ) )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_page_title_area_in_grid',
					'title'       => esc_html__( 'Page Title In Grid', 'mildhill-core' ),
					'description' => esc_html__( 'Enabling this option will set page title area to be in grid', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height',
					'title'       => esc_html__( 'Height', 'mildhill-core' ),
					'description' => esc_html__( 'Enter title height', 'mildhill-core' ),
					'args'        => array(
						'suffix' => 'px'
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_title_background_color',
					'title'       => esc_html__( 'Background Color', 'mildhill-core' ),
					'description' => esc_html__( 'Enter page title area background color', 'mildhill-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_title_background_image',
					'title'       => esc_html__( 'Background Image', 'mildhill-core' ),
					'description' => esc_html__( 'Enter page title area background image', 'mildhill-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_page_title_background_image_behavior',
					'title'      => esc_html__( 'Background Image Behavior', 'mildhill-core' ),
					'options'    => array(
						''           => esc_html__( 'Default', 'mildhill-core' ),
						'responsive' => esc_html__( 'Set Responsive Image', 'mildhill-core' ),
						'parallax'   => esc_html__( 'Set Parallax Image', 'mildhill-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_color',
					'title'      => esc_html__( 'Title Color', 'mildhill-core' )
				)
			);


			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_tag',
					'title'         => esc_html__( 'Title tag', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will set title tag', 'mildhill-core' ),
					'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h5',
					'dependency'    => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( 'standard-with-breadcrumbs', 'standard' ),
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_text_alignment',
					'title'         => esc_html__( 'Text Alignment', 'mildhill-core' ),
					'options'       => array(
						'left'   => esc_html__( 'Left', 'mildhill-core' ),
						'center' => esc_html__( 'Center', 'mildhill-core' ),
						'right'  => esc_html__( 'Right', 'mildhill-core' )
					),
					'default_value' => 'left'
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_vertical_text_alignment',
					'title'         => esc_html__( 'Vertical Text Alignment', 'mildhill-core' ),
					'options'       => array(
						''              => esc_html__( 'Default', 'mildhill-core' ),
						'header-bottom' => esc_html__( 'From Bottom of Header', 'mildhill-core' ),
						'window-top'    => esc_html__( 'From Window Top', 'mildhill-core' )
					),
					'default_value' => ''
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_page_title_meta_box_map', $page_title_section );
		}
	}

	add_action( 'mildhill_core_action_after_general_meta_box_map', 'mildhill_core_add_page_title_meta_box' );
	add_action( 'mildhill_core_action_after_portfolio_meta_box_map', 'mildhill_core_add_page_title_meta_box' );
}