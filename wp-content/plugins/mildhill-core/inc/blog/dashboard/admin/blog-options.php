<?php

if ( ! function_exists( 'mildhill_core_add_blog_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_blog_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'blog',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Blog', 'mildhill-core' ),
				'description' => esc_html__( 'Global settings related to page', 'mildhill-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {
			$custom_sidebars = mildhill_core_get_custom_sidebars();

			$general_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-general',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog General', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to blog general', 'mildhill-core' )
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_blog_general_center_content',
					'title'         => esc_html__( 'Center Content', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will center content on blog lists and singles', 'mildhill-core' ),
					'default_value' => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_blog_general_options_map', $general_tab );

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog List', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to blog list', 'mildhill-core' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_blog_list_excerpt_number_of_characters',
					'title'       => esc_html__( 'Number of Characters in Excerpt', 'mildhill-core' ),
					'description' => esc_html__( 'Fill a number of characters in excerpt for post summary. Default value is 180', 'mildhill-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for blog archive', 'mildhill-core' ),
					'options'       => mildhill_core_get_select_type_options_pool( 'sidebar_layouts' ),
					'default_value' => ''
				)
			);

			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_blog_archive_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'mildhill-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on blog archive', 'mildhill-core' ),
						'options'     => $custom_sidebars
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_single_archive_grid_gutter',
					'title'         => esc_html__( 'Set Grid Gutter', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose grid gutter size to set space between content and sidebar for blog archive', 'mildhill-core' ),
					'options'       => mildhill_core_get_select_type_options_pool( 'items_space' ),
					'default_value' => ''
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_blog_list_options_map', $list_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Blog Single', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to blog single', 'mildhill-core' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'mildhill-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title on blog single', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_layout',
					'title'       => esc_html__( 'Sidebar Layout', 'mildhill-core' ),
					'description' => esc_html__( 'Choose default sidebar layout for blog single', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'sidebar_layouts' )
				)
			);

			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$single_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_blog_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'mildhill-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on blog single', 'mildhill-core' ),
						'options'     => $custom_sidebars
					)
				);
			}

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_blog_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'mildhill-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar for blog single', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'items_space' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_blog_single_options_map', $single_tab );

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_blog_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_blog_options', mildhill_core_get_admin_options_map_position( 'blog' ) );
}