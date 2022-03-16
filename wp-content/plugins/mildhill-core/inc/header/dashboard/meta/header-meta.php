<?php

if ( ! function_exists( 'mildhill_core_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Header layout settings', 'mildhill-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'mildhill-core' ),
					'description' => esc_html__( 'Choose header layout to set for your site', 'mildhill-core' ),
					'args'        => array( 'images' => true ),
					'options'     => mildhill_core_header_radio_to_select_options( apply_filters( 'mildhill_core_filter_header_layout_option', $header_layout_options = array() ) )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'mildhill-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'mildhill-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'mildhill-core' ),
						'none'  => esc_html__( 'None', 'mildhill-core' ),
						'light' => esc_html__( 'Light', 'mildhill-core' ),
						'dark'  => esc_html__( 'Dark', 'mildhill-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_scroll_appearance',
					'title'       => esc_html__( 'Header Scroll Appearance', 'mildhill-core' ),
					'description' => esc_html__( 'Choose how header will act on scroll', 'mildhill-core' ),
					'options'     => apply_filters( 'mildhill_core_filter_header_scroll_appearance_option', $header_scroll_appearance_options = array(
						''     => esc_html__( 'Default', 'mildhill-core' ),
						'none' => esc_html__( 'None', 'mildhill-core' )
					) )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_bottom_shadow',
					'title'       => esc_html__( 'Header Bottom Shadow', 'mildhill-core' ),
					'description' => esc_html__( 'Enable header bottom shadow', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'mildhill-core' ),
					'default_value' => 'yes'
				)
			);

			$custom_sidebars = mildhill_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array(
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array(
							'show' => array(
								'qodef_show_header_widget_areas' => array(
									'values'        => 'yes',
									'default_value' => 'yes'
								)
							)
						)
					)
				);
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area One', 'mildhill-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'mildhill-core' ),
						'options'     => $custom_sidebars
					)
				);
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_two',
						'title'       => esc_html__( 'Choose Custom Header Widget Area Two', 'mildhill-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'mildhill-core' ),
						'options'     => $custom_sidebars
					)
				);

				// Hook to include additional options after module options
				do_action( 'mildhill_core_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_page_header_meta_map', $header_tab );
		}
	}

	add_action( 'mildhill_core_action_after_general_meta_box_map', 'mildhill_core_add_page_header_meta_box' );
	add_action( 'mildhill_core_action_after_portfolio_meta_box_map', 'mildhill_core_add_page_header_meta_box' );
}