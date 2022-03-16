<?php

if ( ! function_exists( 'mildhill_core_add_product_list_variation_info_right' ) ) {
	function mildhill_core_add_product_list_variation_info_right( $variations ) {
		$variations['info-right'] = esc_html__( 'Info Right', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_product_list_layouts', 'mildhill_core_add_product_list_variation_info_right' );
}

if ( ! function_exists( 'mildhill_core_register_shop_list_info_right_actions' ) ) {
	function mildhill_core_register_shop_list_info_right_actions() {
		// Add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'mildhill_core_add_product_list_item_holder', 5 ); // priority 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		add_action( 'woocommerce_before_shop_loop_item', 'mildhill_core_add_product_list_item_content_outer_holder', 6 ); // priority 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_content_outer_holder_end', 27 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder', 5 ); // priority 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10


		// Add additional tags around content inside product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_additional_image_holder', 15 ); // priority 15 is set because woocommerce_template_loop_product_thumbnail hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_additional_image_holder_end', 25 ); // priority 25 is set because mildhill_core_add_product_list_item_image_holder_end hook is added on 30

		// Add additional tags around product list item content
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_content_holder', 5 ); // priority 5 is set because woocommerce_template_loop_product_title hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_content_holder_end', 20 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add additional tags around title and price
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_title_price_holder', 6 ); // priority 9 is set because woocommerce_template_loop_product_title hook is added on 10
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_title_price_holder_end', 14 ); // priority 12 is set because woocommerce_template_loop_price hook is added on 11


		//Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); // priority 10 is default
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );

		// Change add to cart position
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // priority 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_woo_add_product_list_item_buttons_holder', 24 ); // priority 24 is set because mildhill_core_add_product_list_item_base_price_rating_holder_end hook is added on 23


		//Remove sale flash
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); // priority 10 is default
		remove_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_out_of_stock_mark_on_product', 10 ); // priority 10 is default
		remove_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_new_mark_on_product', 10 ); // priority 10 is default

		remove_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_add_product_list_item_background_holder', 28 );

		remove_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_get_yith_countdown_on_list', 28 );
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_get_yith_countdown_on_list', 27 );

	}

	add_action( 'mildhill_core_action_shop_list_item_layout_info-right', 'mildhill_core_register_shop_list_info_right_actions' );
}