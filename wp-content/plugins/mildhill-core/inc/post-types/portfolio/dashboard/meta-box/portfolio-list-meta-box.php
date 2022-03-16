<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that adds portfolio list settings for portfolio single module
	 */
	function mildhill_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'mildhill-core' )
				)
			);

			$list_tab->add_field_element( array(
				'field_type'  => 'image',
				'name'        => 'qodef_portfolio_list_image',
				'title'       => esc_html__( 'Portfolio List Image', 'mildhill-core' ),
				'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'mildhill-core' ),
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_masonry_image_dimension_portfolio-item',
				'title'       => esc_html__( 'Image Dimension', 'mildhill-core' ),
				'description' => esc_html__( 'Choose dimension of image for "masonry behavior" portfolio list. If you are using fixed images proportion on list, choose option different than default.', 'mildhill-core' ),
				'options'     => mildhill_core_get_select_type_options_pool( 'masonry_image_dimension' )
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_item_padding',
				'title'       => esc_html__( 'Portfolio Item Custom Padding', 'mildhill-core' ),
				'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'mildhill-core' )
			) );

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'mildhill_core_action_after_portfolio_meta_box_map', 'mildhill_core_add_portfolio_item_list_meta_boxes' );
}