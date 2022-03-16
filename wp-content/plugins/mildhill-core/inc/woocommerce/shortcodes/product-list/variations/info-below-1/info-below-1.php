<?php

if ( ! function_exists( 'mildhill_core_add_product_list_variation_info_below_1' ) ) {
	function mildhill_core_add_product_list_variation_info_below_1( $variations ) {
		$variations['info-below-1'] = esc_html__( 'Info Below 1', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_product_list_layouts', 'mildhill_core_add_product_list_variation_info_below_1' );
}

if ( ! function_exists( 'mildhill_core_register_shop_list_info_below_1_actions' ) ) {
	function mildhill_core_register_shop_list_info_below_1_actions() {
		// Add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'mildhill_core_add_product_list_item_holder', 5 ); // priority 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder', 5 ); // priority 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

		// Add additional tags around product list item content
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_content_holder', 5 ); // priority 5 is set because woocommerce_template_loop_product_title hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_content_holder_end', 20 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );  // priority 11 is set because woocommerce_template_loop_product_title hook is added on 10

		// Add additional tags around title and price
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_title_price_holder', 9 ); // priority 9 is set because woocommerce_template_loop_product_title hook is added on 10
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_title_price_holder_end', 12 ); // priority 12 is set because woocommerce_template_loop_price hook is added on 11

		// Add base price
		add_action( 'woocommerce_after_shop_loop_item_title', 'mildhill_core_woo_product_get_base_price_html', 4 ); // priority 4 is set because woocommerce_template_loop_rating hook is added on 5

		// Change add to cart position for product list item
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_add_product_list_item_buttons_holder', 19 ); // priority 19 is set because mildhill_core_add_product_list_item_content_holder_end hook is added on 20
	}

	add_action( 'mildhill_core_action_shop_list_item_layout_info-below-1', 'mildhill_core_register_shop_list_info_below_1_actions' );
}