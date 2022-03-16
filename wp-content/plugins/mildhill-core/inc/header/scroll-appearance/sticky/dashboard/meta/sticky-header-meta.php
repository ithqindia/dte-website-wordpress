<?php

if ( ! function_exists( 'mildhill_core_add_sticky_header_meta_options' ) ) {
	function mildhill_core_add_sticky_header_meta_options( $page, $custom_sidebars ) {
		
		if ( $page ) {
			
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
			
			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_custom_widget_area_one',
					'title'       => esc_html__( 'Choose Custom Sticky Header Widget Area', 'mildhill-core' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header widget area', 'mildhill-core' ),
					'options'     => $custom_sidebars,
					'dependency'  => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => ''
							)
						)
					)
				)
			);
		}
	}
	
	add_action( 'mildhill_core_action_after_custom_widget_area_header_meta_map', 'mildhill_core_add_sticky_header_meta_options', 10, 2 );
}