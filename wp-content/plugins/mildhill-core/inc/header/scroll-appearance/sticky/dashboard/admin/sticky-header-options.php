<?php

if ( ! function_exists( 'mildhill_core_add_sticky_header_options' ) ) {
	function mildhill_core_add_sticky_header_options( $page ) {
		
		$page->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_scroll_amount',
				'title'       => esc_html__( 'Sticky Scroll Amount', 'mildhill-core' ),
				'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'mildhill-core' ),
				'args'        => array(
					'suffix' => 'px'
				),
				'dependency' => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values' => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
	}
	
	add_action( 'mildhill_core_action_after_header_options_map', 'mildhill_core_add_sticky_header_options', 9);
}