<?php

if ( ! function_exists( 'mildhill_core_add_woocommerce_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_woocommerce_options() {
		$qode_framework = qode_framework_get_framework_root();

		$list_item_layouts = apply_filters( 'mildhill_core_filter_product_list_layouts', array() );
		$options_map       = mildhill_core_get_variations_options_map( $list_item_layouts );

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'woocommerce',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'WooCommerce', 'mildhill-core' ),
				'description' => esc_html__( 'Global settings related to WooCommerce', 'mildhill-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Product List', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to product list', 'mildhill-core' )
				)
			);

			if ( $options_map['visibility'] ) {
				$list_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_product_list_item_layout',
						'title'         => esc_html__( 'Item Layout', 'mildhill-core' ),
						'description'   => esc_html__( 'Choose layout for list item on shop list', 'mildhill-core' ),
						'options'       => $list_item_layouts,
						'default_value' => $options_map['default_value']
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns',
					'title'       => esc_html__( 'Columns Number', 'mildhill-core' ),
					'description' => esc_html__( 'Choose number of columns for product list on shop page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'columns_number' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns_space',
					'title'       => esc_html__( 'Space Between Items', 'mildhill-core' ),
					'description' => esc_html__( 'Choose space between items for product list on shop page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'items_space' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_products_per_page',
					'title'       => esc_html__( 'Products per Page', 'mildhill-core' ),
					'description' => esc_html__( 'Set number of products on shop page. Default value is 12', 'mildhill-core' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_title_tag',
					'title'       => esc_html__( 'Title Tag', 'mildhill-core' ),
					'description' => esc_html__( 'Choose title tag for product list item on shop page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'title_tag' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_product_list_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'mildhill-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for shop page', 'mildhill-core' ),
					'default_value' => 'no-sidebar',
					'options'       => mildhill_core_get_select_type_options_pool( 'sidebar_layouts', false )
				)
			);

			$custom_sidebars = mildhill_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_woo_product_list_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'mildhill-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on shop page', 'mildhill-core' ),
						'options'     => $custom_sidebars
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'mildhill-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'items_space' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_woo_product_list_percent_sign',
					'title'         => esc_html__( 'Enable Percent Sign', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products on shop page. Applied to simple and external types of products.', 'mildhill-core' ),
					'default_value' => 'no'
				)
			);

			// Hook to include additional options after section module options
			do_action( 'mildhill_core_action_after_woo_product_list_options_map', $list_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Product Single', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to product single', 'mildhill-core' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'mildhill-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title on single product page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_title_tag',
					'title'       => esc_html__( 'Title Tag', 'mildhill-core' ),
					'description' => esc_html__( 'Choose title tag for product on single product page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'title_tag' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_single_enable_image_lightbox',
					'title'         => esc_html__( 'Enable Image Lightbox', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will set lightbox functionality for images on single product page', 'mildhill-core' ),
					'options'       => array(
						''               => esc_html__( 'None', 'mildhill-core' ),
						'photo-swipe'    => esc_html__( 'Photo Swipe', 'mildhill-core' ),
						'magnific-popup' => esc_html__( 'Magnific Popup', 'mildhill-core' ),
					),
					'default_value' => 'magnific-popup'
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_woo_single_enable_image_zoom',
					'title'         => esc_html__( 'Enable Zoom Maginfier', 'mildhill-core' ),
					'description'   => esc_html__( 'Enabling this option will show magnifier image on hover on single product page', 'mildhill-core' ),
					'default_value' => 'yes'
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_thumbnail_images_columns',
					'title'       => esc_html__( 'Thumbnail Images Columns Number', 'mildhill-core' ),
					'description' => esc_html__( 'Choose number of columns for thumbnail images on single product page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'columns_number' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_related_product_list_columns',
					'title'       => esc_html__( 'Columns Number', 'mildhill-core' ),
					'description' => esc_html__( 'Choose number of columns for related product list on single product page', 'mildhill-core' ),
					'options'     => mildhill_core_get_select_type_options_pool( 'columns_number' )
				)
			);

			// Hook to include additional options after section module options
			do_action( 'mildhill_core_action_after_woo_product_single_options_map', $single_tab );

			$widget_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-widget',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Dropdown Widget', 'mildhill-core' ),
					'description' => esc_html__( 'Settings related to cart dropdown widget', 'mildhill-core' )
				)
			);

			$widget_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_cart_dropdown_icon_source',
					'title'         => esc_html__( 'Icon Source', 'mildhill-core' ),
					'default_value' => 'predefined',
					'options'       => mildhill_core_get_select_type_options_pool( 'icon_source', false )
				)
			);

			$widget_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_cart_dropdown_icon_pack',
					'title'         => esc_html__( 'Icon Pack', 'mildhill-core' ),
					'description'   => esc_html__( '', 'mildhill-core' ),
					'default_value' => 'elegant-icons',
					'options'       => qode_framework_icons()->get_icon_packs( array(
						'linea-icons',
						'dripicons',
						'simple-line-icons'
					) ),
					'dependency'    => array(
						'show' => array(
							'qodef_cart_dropdown_icon_source' => array(
								'values'        => 'icon_pack',
								'default_value' => 'predefined'
							)
						)
					)
				)
			);

			$section_svg_path = $widget_tab->add_section_element(
				array(
					'title'      => esc_html__( 'SVG Path', 'mildhill-core' ),
					'name'       => 'qodef_cart_dropdown_svg_path_section',
					'dependency' => array(
						'show' => array(
							'qodef_cart_dropdown_icon_source' => array(
								'values'        => 'svg_path',
								'default_value' => 'icon_pack'
							)
						)
					)
				)
			);

			$section_svg_path->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_cart_dropdown_icon_svg_path',
					'title'       => esc_html__( 'Cart Dropdown Icon SVG Path', 'mildhill-core' ),
					'description' => esc_html__( 'Enter your cart dropdown icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'mildhill-core' )
				)
			);

			// Hook to include additional options after section module options
			do_action( 'mildhill_core_action_after_woo_product_single_options_map', $widget_tab );

			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_woo_options_map', $page );
		}
	}

	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_woocommerce_options', mildhill_core_get_admin_options_map_position( 'woocommerce' ) );
}