<?php

$product = mildhill_core_woo_get_global_product();

if ( ! empty( $product ) && $product->is_on_sale() ) {
	$percent_sign = ! empty( $params['percent_sign'] ) ? $params['percent_sign'] : '';
	echo mildhill_core_woo_sale_flash( true, $percent_sign );
}

if ( ! empty( $product ) && ! $product->is_in_stock() ) {
	echo mildhill_core_get_out_of_stock_mark();
}

if ( ! empty( $product ) && $product->get_id() !== '' ) {
	echo mildhill_core_get_new_mark( $product->get_id() );
}