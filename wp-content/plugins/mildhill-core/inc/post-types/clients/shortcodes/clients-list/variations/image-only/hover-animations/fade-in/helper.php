<?php
if ( ! function_exists( 'mildhill_core_filter_clients_list_image_only_fade_in' ) ) {
	function mildhill_core_filter_clients_list_image_only_fade_in( $variations ) {
		
		$variations['fade-in'] = esc_html__( 'Fade In', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_clients_list_image_only_animation_options', 'mildhill_core_filter_clients_list_image_only_fade_in' );
}