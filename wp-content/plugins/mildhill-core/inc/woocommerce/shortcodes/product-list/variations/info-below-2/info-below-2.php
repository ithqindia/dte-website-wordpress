<?php

if ( ! function_exists( 'mildhill_core_add_product_list_variation_info_below_2' ) ) {
	function mildhill_core_add_product_list_variation_info_below_2( $variations ) {
		$variations['info-below-2'] = esc_html__( 'Info Below 2', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_product_list_layouts', 'mildhill_core_add_product_list_variation_info_below_2' );
}

if ( ! function_exists( 'mildhill_core_register_shop_list_info_below_2_actions' ) ) {
	function mildhill_core_register_shop_list_info_below_2_actions() {
		// Add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'mildhill_core_add_product_list_item_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_link_open hook is added on 20
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 20

		// Add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 20
		add_action( 'woocommerce_before_shop_loop_item_title', 'mildhill_core_add_product_list_item_image_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 20

		// Add additional tags around product list item content
		add_action( 'woocommerce_shop_loop_item_title', 'mildhill_core_add_product_list_item_content_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_title hook is added on 20
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_add_product_list_item_content_holder_end', 20 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 20

		// Remove rating
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

		// Change add to cart position for product list item
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // priority 10 is default
		add_action( 'woocommerce_after_shop_loop_item', 'mildhill_core_woo_add_product_list_item_buttons_holder', 19 ); // priority 19 is set because mildhill_core_add_product_list_item_content_holder_end hook is added on 20
	}

	add_action( 'mildhill_core_action_shop_list_item_layout_info-below-2', 'mildhill_core_register_shop_list_info_below_2_actions' );
}