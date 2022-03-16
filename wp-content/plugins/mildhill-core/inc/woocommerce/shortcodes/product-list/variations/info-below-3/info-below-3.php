<?php

if ( ! function_exists( 'mildhill_core_add_product_list_variation_info_below_3' ) ) {
	function mildhill_core_add_product_list_variation_info_below_3( $variations ) {
		$variations['info-below-3'] = esc_html__( 'Info Below 3', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_product_list_layouts', 'mildhill_core_add_product_list_variation_info_below_3' );
}

if ( ! function_exists( 'mildhill_core_register_shop_list_info_below_3_actions' ) ) {
	function mildhill_core_register_shop_list_info_below_3_actions() {
		// remove default positions
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_woo_shop_loop_item_title', 10 ); // priority 10 is default
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

		// add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'mildhill_core_add_product_list_item_holder', 5 ); // priority 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder', 5 ); // priority 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

		//////////////////////////////////////////////////////////////////////

		// add additional tags around product list item content begin
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_content_holder', 5 );

		///////////////////////////////////

		// add additional tags around title and price begin
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_title_price_holder', 16 );

		// add title
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_shop_loop_item_title', 17 );

		// add price
		add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 18 );

		// add additional tags around title and price end
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_title_price_holder_end', 19 );

		///////////////////////////////////

		// add additional tags around base price and rating begin
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_base_price_rating_holder', 20 );

		// Add base price
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_product_get_base_price_html', 20 );

		// add rating
		add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 20 );

		// add additional tags around base price and rating end
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_base_price_rating_holder_end', 20 );

		///////////////////////////////////

		// add buttons
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_add_product_list_item_buttons_holder', 20 );

		///////////////////////////////////

		// add additional tags around product list item content end
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_content_holder_end', 20 );

		//////////////////////////////////////////////////////////////////////
	}

	add_action( 'mildhill_core_action_shop_list_item_layout_info-below-3', 'mildhill_core_register_shop_list_info_below_3_actions' );
}