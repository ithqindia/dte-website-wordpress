<?php

if ( ! function_exists( 'mildhill_core_add_clients_list_variation_image_only' ) ) {
	function mildhill_core_add_clients_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_clients_list_layouts', 'mildhill_core_add_clients_list_variation_image_only' );
}