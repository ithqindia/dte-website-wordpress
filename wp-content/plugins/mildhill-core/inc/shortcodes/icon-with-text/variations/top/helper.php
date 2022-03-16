<?php

if ( ! function_exists( 'mildhill_core_add_icon_with_text_variation_top' ) ) {
	function mildhill_core_add_icon_with_text_variation_top( $variations ) {
		
		$variations['top'] = esc_html__( 'Top', 'mildhill-core' );
		
		return $variations;
	}
	
	add_filter( 'mildhill_core_filter_icon_with_text_layouts', 'mildhill_core_add_icon_with_text_variation_top' );
}

if ( ! function_exists( 'mildhill_core_add_icon_with_text_options_text_align' ) ) {
	function mildhill_core_add_icon_with_text_options_text_align( $options, $default_layout ) {
		$icon_with_text_options   = array();
		
		$alignment_option = array(
			'field_type' => 'select',
			'name'       => 'content_alignment',
			'title'      => esc_html__( 'Content Alignment', 'mildhill-core' ),
			'options'       => array(
				''       => esc_html__( 'Default', 'mildhill-core' ),
				'left'   => esc_html__( 'Left', 'mildhill-core' ),
				'center' => esc_html__( 'Center', 'mildhill-core' ),
				'right'  => esc_html__( 'Right', 'mildhill-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'top',
						'default_value' => $default_layout
					)
				)
			),
			'group'      => esc_html__( 'Content', 'mildhill-core' )
		);
		
		$icon_with_text_options[] = $alignment_option;
		
		return array_merge( $options, $icon_with_text_options );
	}
	
	add_filter( 'mildhill_core_filter_icon_with_text_extra_options', 'mildhill_core_add_icon_with_text_options_text_align', 10, 2 );
}

if ( ! function_exists( 'mildhill_core_add_icon_with_text_classes_alignment' ) ) {
	
	function mildhill_core_add_icon_with_text_classes_alignment( $holder_classes, $atts ) {
		
		if( $atts['layout'] == 'top' ) {
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ?  'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--center';
		}
		
		return $holder_classes;
	}
	
	add_filter( 'mildhill_core_filter_icon_with_text_variation_classes', 'mildhill_core_add_icon_with_text_classes_alignment', 10, 2 );
}