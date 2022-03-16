<?php

if ( ! function_exists( 'mildhill_core_add_fixed_header_options' ) ) {
	function mildhill_core_add_fixed_header_options( $page ) {
	
	}
	
	add_action( 'mildhill_core_action_after_header_options_map', 'mildhill_core_add_fixed_header_options' );
}