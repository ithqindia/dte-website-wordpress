<?php

if ( ! function_exists( 'mildhill_core_add_product_categories_list_variation_info_on_image' ) ) {
	function mildhill_core_add_product_categories_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_product_categories_list_layouts', 'mildhill_core_add_product_categories_list_variation_info_on_image' );
}