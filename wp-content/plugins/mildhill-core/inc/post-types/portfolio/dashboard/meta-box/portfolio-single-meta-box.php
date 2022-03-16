<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_portfolio_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'portfolio-item' ),
				'type'   => 'meta',
				'slug'   => 'portfolio-item',
				'title'  => esc_html__( 'Portfolio Settings', 'mildhill-core' ),
				'layout' => 'tabbed'
			)
		);

		if ( $page ) {

			$general_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-general',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'General Settings', 'mildhill-core' ),
					'description' => esc_html__( 'General portfolio settings', 'mildhill-core' )
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_layout',
					'title'       => esc_html__( 'Single Layout', 'mildhill-core' ),
					'description' => esc_html__( 'Choose default layout for portfolio single', 'mildhill-core' ),
					'options'     => apply_filters( 'mildhill_core_filter_portfolio_single_layout_options', array( '' => esc_html__( 'Default', 'mildhill-core' ) ) )
				)
			);

			$section_columns = $general_tab->add_section_element(
				array(
					'name'       => 'qodef_portfolio_columns_section',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_single_layout' => array(
								'values'        => array(
									'masonry-big',
									'masonry-small',
									'gallery-big',
									'gallery-small'
								),
								'default_value' => ''
							)
						)
					)
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_columns_number',
					'title'      => esc_html__( 'Number of Columns', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'columns_number' )
				)
			);

			$section_columns->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_space_between_items',
					'title'      => esc_html__( 'Space Between Items', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'items_space' )
				)
			);

			$section_media = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_media_section',
					'title'       => esc_html__( 'Media Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Media that will be displayed on portfolio page', 'mildhill-core' )
				)
			);

			$media_repeater = $section_media->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_media',
					'title'       => esc_html__( 'Media Items', 'mildhill-core' ),
					'description' => esc_html__( 'Enter media items for this portfolio', 'mildhill-core' ),
					'button_text' => esc_html__( 'Add Media', 'mildhill-core' )
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_media_type',
					'title'         => esc_html__( 'Media Item Type', 'mildhill-core' ),
					'options'       => array(
						'gallery' => esc_html__( 'Gallery', 'mildhill-core' ),
						'image'   => esc_html__( 'Image', 'mildhill-core' ),
						'video'   => esc_html__( 'Video', 'mildhill-core' ),
						'audio'   => esc_html__( 'Audio', 'mildhill-core' ),
					),
					'default_value' => 'gallery'
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_gallery',
					'title'      => esc_html__( 'Upload Portfolio Images', 'mildhill-core' ),
					'multiple'   => 'yes',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'gallery',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_image',
					'title'      => esc_html__( 'Upload Portfolio Image', 'mildhill-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'image',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_video',
					'title'       => esc_html__( 'Video URL', 'mildhill-core' ),
					'description' => esc_html__( 'Enter your video url', 'mildhill-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'video',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);

			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_audio',
					'title'       => esc_html__( 'Audio URL', 'mildhill-core' ),
					'description' => esc_html__( 'Enter your audio url', 'mildhill-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'audio',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);

			$section_info = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_info_section',
					'title'       => esc_html__( 'Info Settings', 'mildhill-core' ),
					'description' => esc_html__( 'Info that will be displayed on portfolio page', 'mildhill-core' )
				)
			);

			$info_items_repeater = $section_info->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_info_items',
					'title'       => esc_html__( 'Info Items', 'mildhill-core' ),
					'description' => esc_html__( 'Enter additional info for portoflio item', 'mildhill-core' ),
					'button_text' => esc_html__( 'Add Item', 'mildhill-core' )
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_label',
					'title'      => esc_html__( 'Item Label', 'mildhill-core' )
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_value',
					'title'      => esc_html__( 'Item Text', 'mildhill-core' )
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_link',
					'title'      => esc_html__( 'Item Link', 'mildhill-core' )
				)
			);

			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_info_item_target',
					'title'      => esc_html__( 'Item Target', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'link_target' )
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_back_to_link',
					'title'       => esc_html__( '"Back To" Link', 'mildhill-core' ),
					'description' => esc_html__( 'Choose "Back To" page to link from portfolio single', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'all_pages' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_portfolio_meta_box_map', $page, $general_tab );
		}
	}

	add_action( 'mildhill_core_action_default_meta_boxes_init', 'mildhill_core_add_portfolio_single_meta_box' );
}