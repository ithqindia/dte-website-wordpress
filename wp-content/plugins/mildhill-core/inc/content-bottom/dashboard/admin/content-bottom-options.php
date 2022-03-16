<?php

if ( ! function_exists( 'mildhill_core_add_page_content_bottom_options' ) ) {
	/**
	 * function that add general options for this module
	 */
	function mildhill_core_add_page_content_bottom_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'content-bottom',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Content bottom', 'mildhill-core' ),
				'description' => esc_html__( 'Global settings related to page content bottom', 'mildhill-core' )
			)
		);

		if ( $page ) {
			$custom_sidebars = mildhill_core_get_custom_sidebars( false );

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_content_bottom',
					'title'         => esc_html__( 'Enable Page Content bottom', 'mildhill-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page content bottom', 'mildhill-core' ),
					'default_value' => 'no'
				)
			);

			$page_content_bottom_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_content_bottom_section',
					'title'      => esc_html__( 'Content Bottom Area', 'mildhill-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_content_bottom' => array(
								'values'        => 'no',
								'default_value' => 'no'
							)
						)
					)
				)
			);

			$page_content_bottom_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_content_bottom_area_in_grid',
					'title'         => esc_html__( 'Content Bottom In Grid', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will set page content bottom to be in grid', 'mildhill-core' ),
					'options'       => mildhill_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no'
				)
			);

			if ( ! empty( $custom_sidebars ) ) {
				$page_content_bottom_section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_content_bottom_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'mildhill-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display in content bottom area', 'mildhill-core' ),
						'options'     => $custom_sidebars
					)
				);
			}

			// hook to include additional options after module options
			do_action( 'mildhill_core_action_after_page_content_bottom_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_page_content_bottom_options', mildhill_core_get_admin_options_map_position( 'content-bottom' ) );
}