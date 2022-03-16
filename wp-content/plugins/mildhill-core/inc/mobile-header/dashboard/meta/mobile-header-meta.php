<?php

if ( ! function_exists( 'mildhill_core_add_page_mobile_header_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_page_mobile_header_meta_box( $page ) {
		
		if ( $page ) {
			
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Mobile header layout settings', 'mildhill-core' )
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_header_layout',
					'title'       => esc_html__( 'Mobile Header Layout', 'mildhill-core' ),
					'description' => esc_html__( 'Choose mobile header layout to set for your site', 'mildhill-core' ),
					'args'        => array( 'images' => true ),
					'options'     => mildhill_core_header_radio_to_select_options( apply_filters( 'mildhill_core_filter_mobile_header_layout_option', $mobile_header_layout_options = array() ) )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_page_mobile_header_meta_map', $mobile_header_tab );
		}
	}
	
	add_action( 'mildhill_core_action_after_general_meta_box_map', 'mildhill_core_add_page_mobile_header_meta_box' );
	add_action( 'mildhill_core_action_after_portfolio_meta_box_map', 'mildhill_core_add_page_mobile_header_meta_box' );
}