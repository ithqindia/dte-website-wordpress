<?php

if ( ! function_exists( 'mildhill_core_add_testimonials_meta_box' ) ) {
	/**
	 * Function that adds fields for testimonials
	 */
	function mildhill_core_add_testimonials_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'testimonials' ),
				'type'  => 'meta',
				'slug'  => 'testimonials',
				'title' => esc_html__( 'Testimonials Parameters', 'mildhill-core' )
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_title',
					'title'      => esc_html__( 'Title', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_text',
					'title'      => esc_html__( 'Text', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_author',
					'title'      => esc_html__( 'Author', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_testimonials_author_job',
					'title'      => esc_html__( 'Author Job Title', 'mildhill-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_testimonials_meta_box_map', $page );
		}
	}
	
	add_action( 'mildhill_core_action_default_meta_boxes_init', 'mildhill_core_add_testimonials_meta_box' );
}