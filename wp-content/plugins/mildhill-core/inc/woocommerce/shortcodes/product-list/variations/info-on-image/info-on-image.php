<?php

if ( ! function_exists( 'mildhill_core_add_product_list_variation_info_on_image' ) ) {
	function mildhill_core_add_product_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_product_list_layouts', 'mildhill_core_add_product_list_variation_info_on_image' );
}

if ( ! function_exists( 'mildhill_core_register_shop_list_info_on_image_actions' ) ) {
	function mildhill_core_register_shop_list_info_on_image_actions() {

		// Add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'mildhill_core_add_product_list_item_holder', 5 ); // priority 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder', 5 ); // priority 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder_end', 30 ); // priority 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

		// Add additional tags around content inside product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_additional_image_holder', 15 ); // priority 15 is set because woocommerce_template_loop_product_thumbnail hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_additional_image_holder_end', 25 ); // priority 25 is set because mildhill_core_add_product_list_item_image_holder_end hook is added on 30

		// Change title position
		remove_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_woo_shop_loop_item_title', 10 ); // priority 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_woo_shop_loop_item_title', 18 ); // priority 18 is set because mildhill_core_add_product_list_item_title_price_holder hook is added on 17

		// Add additional tags around title and price
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_title_price_holder', 17 ); // priority 17 is set because mildhill_core_woo_add_product_list_item_buttons_holder hook is added on 16
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_title_price_holder_end', 20 ); // priority 20 is set because mildhill_core_woo_shop_loop_item_title hook is added on 19

		// Change price position
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); // priority 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 19 ); // priority 19 is set because mildhill_core_add_product_list_item_title_price_holder_end hook is added on 18

		// Remove rating
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

		// Change add to cart position
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // priority 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_woo_add_product_list_item_buttons_holder', 16 ); // priority 16 is set because mildhill_core_add_product_list_item_additional_image_holder hook is added on 15
	}

	add_action( 'mildhill_core_action_shop_list_item_layout_info-on-image', 'mildhill_core_register_shop_list_info_on_image_actions' );
}