<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_archive_list_options' ) ) {
	/**
	 * Function that add list options for portfolio archive module
	 */
	function mildhill_core_add_portfolio_archive_list_options( $tab ) {
		$list_item_layouts = apply_filters( 'mildhill_core_filter_portfolio_list_layouts', array() );
		$options_map       = mildhill_core_get_variations_options_map( $list_item_layouts );
		
		if ( $tab ) {
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_item_layout',
				'title'         => esc_html__( 'Item Layout', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose layout for list item on archive page', 'mildhill-core' ),
				'options'       => $list_item_layouts,
				'default_value' => $options_map['default_value']
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_behavior',
				'title'         => esc_html__( 'List Behavior', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose behavior for archive list', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'list_behavior' )
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_masonry_images_proportion',
				'title'         => esc_html__( 'Masonry Images Proportion', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose images proportion for archive list', 'mildhill-core' ),
				'options'       => array(
					''      => esc_html__( 'Original', 'mildhill-core' ),
					'fixed' => esc_html__( 'Fixed', 'mildhill-core' )
				),
				'dependency'    => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'masonry',
							'default_value' => 'columns'
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns',
				'title'         => esc_html__( 'Columns Number', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose number of columns for archive list', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' )
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_space',
				'title'         => esc_html__( 'Space Between Items', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose space between items for archive list', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'items_space' )
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_responsive',
				'title'         => esc_html__( 'Columns Responsive', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns responsive for archive list', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_responsive' )
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_1440',
				'title'         => esc_html__( 'Columns Number 1367px - 1440px', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns for screens between 1367 and 1440 px for archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_1366',
				'title'         => esc_html__( 'Columns Number 1025px - 1366px', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns for screens between 1025 and 1366 px for archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_1024',
				'title'         => esc_html__( 'Columns Number 769px - 1024px', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns for screens between 769 and 1024 px for archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_768',
				'title'         => esc_html__( 'Columns Number 681px - 768px', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns for screens between 681 and 768 px for archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_680',
				'title'         => esc_html__( 'Columns Number 481px - 680px', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns for screens between 481 and 680 px for archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_columns_480',
				'title'         => esc_html__( 'Columns Number 0 - 480px', 'mildhill-core' ),
				'description'   => esc_html__( 'Choose columns for screens between 0 and 480 px for archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_slider_loop',
				'title'         => esc_html__( 'Enable Slider Loop', 'mildhill-core' ),
				'description'   => esc_html__( 'Enable loop for slider display of archive list', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_slider_autoplay',
				'title'         => esc_html__( 'Enable Slider Autoplay', 'mildhill-core' ),
				'description'   => esc_html__( 'Enable autoplay for slider display of archive list', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'text',
				'name'          => 'qodef_portfolio_archive_slider_speed',
				'title'         => esc_html__( 'Slider Speed', 'mildhill-core' ),
				'description'   => esc_html__( 'Enter slider speed for slider display of archive list', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_slider_navigation',
				'title'         => esc_html__( 'Enable Slider Navigation', 'mildhill-core' ),
				'description'   => esc_html__( 'Enable navigation for slider display of archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_archive_slider_pagination',
				'title'         => esc_html__( 'Enable Slider Pagination', 'mildhill-core' ),
				'description'   => esc_html__( 'Enable pagination for slider display of archive list', 'mildhill-core' ),
				'default_value' => '3',
				'options'       => mildhill_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'qodef_portfolio_archive_behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
			$tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_portfolio_archive_pagination_type',
				'title'       => esc_html__( 'Pagination', 'mildhill-core' ),
				'description' => esc_html__( 'Choose pagination type for archive list', 'mildhill-core' ),
				'options'     => mildhill_core_get_select_type_options_pool( 'pagination_type' ),
				'dependency'  => array(
					'hide' => array(
						'qodef_portfolio_archive_behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				)
			) );
		}
	}
	
	add_action( 'mildhill_core_action_after_portfolio_options_archive', 'mildhill_core_add_portfolio_archive_list_options' );
}