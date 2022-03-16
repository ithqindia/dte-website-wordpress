<?php

if ( ! function_exists( 'mildhill_core_add_admin_user_options' ) ) {
	function mildhill_core_add_admin_user_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'administrator', 'author', 'editor', 'contributor' ),
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'mildhill-core' ),
				'slug'  => 'admin-options',
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'mildhill-core' ),
					'description' => esc_html__( 'Enter user Facebook profile url', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'mildhill-core' ),
					'description' => esc_html__( 'Enter user Instagram profile url', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'mildhill-core' ),
					'description' => esc_html__( 'Enter user Twitter profile url', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'mildhill-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile url', 'mildhill-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'mildhill-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile url', 'mildhill-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_admin_user_options_map', $page );
		}
	}
	
	add_action( 'mildhill_core_action_register_role_custom_fields', 'mildhill_core_add_admin_user_options' );
}