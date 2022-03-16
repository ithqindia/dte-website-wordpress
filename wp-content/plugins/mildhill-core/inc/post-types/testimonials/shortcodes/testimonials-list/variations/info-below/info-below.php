<?php

if ( ! function_exists( 'mildhill_core_add_testimonials_list_variation_info_below' ) ) {
	function mildhill_core_add_testimonials_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_testimonials_list_layouts', 'mildhill_core_add_testimonials_list_variation_info_below' );
}

if ( ! function_exists( 'mildhill_core_add_testimonials_list_options_info_below' ) ) {
	function mildhill_core_add_testimonials_list_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'mildhill-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => 'default'
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'mildhill-core' )
		);
		$info_below_options[] = $margin_option;
		
		return array_merge( $options, $info_below_options );
	}
	
	add_filter( 'mildhill_core_filter_testimonials_list_extra_options', 'mildhill_core_add_testimonials_list_options_info_below' );
}