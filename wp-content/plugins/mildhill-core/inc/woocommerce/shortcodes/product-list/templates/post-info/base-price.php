<?php

$product = mildhill_core_woo_get_global_product();

if ( ! empty( $product ) ) {
	$raw_price  = $product->get_price();
	$base_price = get_post_meta( $product->get_id(), 'qodef_product_base_price', true );
	$base_unit  = get_post_meta( $product->get_id(), 'qodef_product_base_unit', true );

	if ( ! empty( $raw_price ) ) {
		mildhill_core_woo_product_get_base_price_html();
	}
}
