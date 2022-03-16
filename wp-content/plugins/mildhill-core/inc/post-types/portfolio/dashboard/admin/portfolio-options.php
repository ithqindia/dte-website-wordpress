<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_portfolio_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'portfolio-item',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Portfolio', 'mildhill-core' ),
				'description' => esc_html__( 'Global settings related to portfolio', 'mildhill-core' )
			)
		);

		if ( $page ) {
			$archive_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Archive Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to portfolio archive pages', 'mildhill-core' )
				)
			);
			do_action( 'mildhill_core_action_after_portfolio_options_archive', $archive_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Single Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to portfolio single pages', 'mildhill-core' )
				)
			);
			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_layout',
					'title'         => esc_html__( 'Single Layout', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose default layout for portfolio single', 'mildhill-core' ),
					'default_value' => 'big-images',
					'options'       => apply_filters( 'mildhill_core_filter_portfolio_single_layout_options', array() )
				)
			);
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_sticky_info',
					'title'         => esc_html__( 'Sticky Info', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will make side text sticky on potfolio single', 'mildhill-core' ),
					'default_value' => 'no',
				)
			);


			do_action( 'mildhill_core_action_after_portfolio_options_single', $single_tab );

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_portfolio_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_portfolio_options', mildhill_core_get_admin_options_map_position( 'portfolio' ) );
}