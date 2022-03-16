<?php

$product_categories_list_image = ! empty( get_term_meta( $category_id, 'thumbnail_id', true ) ) ? get_term_meta( $category_id, 'thumbnail_id', true ) : get_option( 'woocommerce_placeholder_image', 0 );
$has_image                     = ! empty ( $product_categories_list_image );

if ( $has_image ) {
	$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && $custom_image_width !== '' ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && $custom_image_height !== '' ? intval( $custom_image_height ) : 0;

	echo mildhill_core_get_list_shortcode_item_image( $image_dimension, $product_categories_list_image, $custom_image_width, $custom_image_height );
}