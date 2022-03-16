<?php

if ( ! function_exists( 'mildhill_core_get_header_logo_image' ) ) {
	function mildhill_core_get_header_logo_image( $slug = '' ) {
		$logo_height          = mildhill_core_get_post_value_through_levels( 'qodef_logo_height' );
		$logo_padding         = mildhill_core_get_post_value_through_levels( 'qodef_logo_padding' );
		$logo_margin          = mildhill_core_get_post_value_through_levels( 'qodef_logo_margin' );
		$logo_main_image_id   = mildhill_core_get_post_value_through_levels( 'qodef_logo_main' );
		$logo_dark_image_id   = mildhill_core_get_post_value_through_levels( 'qodef_logo_dark' );
		$logo_light_image_id  = mildhill_core_get_post_value_through_levels( 'qodef_logo_light' );
		$logo_sticky_image_id = mildhill_core_get_post_value_through_levels( 'qodef_logo_sticky' );
		$customizer_logo      = mildhill_core_get_customizer_logo();

		$parameters = array(
			'logo_styles'       => array(),
			'logo_classes'     => ! empty( $logo_height ) ? 'qodef-height--set' : 'qodef-height--not-set',
			'logo_main_image'   => '',
			'logo_dark_image'   => '',
			'logo_light_image'  => '',
			'logo_sticky_image' => '',
		);

		if ( ! empty( $logo_height ) ) {
			$parameters['logo_styles'][] = 'height:' . intval( $logo_height ) . 'px';
		}
		if ( ! empty( $logo_padding ) ) {
			$parameters['logo_styles'][] = 'padding:' . $logo_padding;
		}
		if ( ! empty( $logo_margin ) ) {
			$parameters['logo_styles'][] = 'margin:' . $logo_margin;
		}

		if ( ! empty( $logo_main_image_id ) ) {
			$logo_main_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--main',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo main', 'mildhill-core' )
			);

			$image      = wp_get_attachment_image( $logo_main_image_id, 'full', false, $logo_main_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_main_image_id, $logo_main_image_attr );

			$parameters['logo_main_image'] = $image_html;
		}

		if ( ! empty( $logo_dark_image_id ) ) {
			$logo_dark_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--dark',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo dark', 'mildhill-core' )
			);

			$parameters['logo_dark_image'] = wp_get_attachment_image( $logo_dark_image_id, 'full', false, $logo_dark_image_attr );
		}

		if ( ! empty( $logo_light_image_id ) ) {
			$logo_light_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--light',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo main', 'mildhill-core' )
			);

			$parameters['logo_light_image'] = wp_get_attachment_image( $logo_light_image_id, 'full', false, $logo_light_image_attr );
		}

		if ( ! empty( $logo_sticky_image_id ) ) {
			$logo_sticky_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--sticky',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo sticky', 'mildhill-core' )
			);

			$image      = wp_get_attachment_image( $logo_sticky_image_id, 'full', false, $logo_sticky_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_sticky_image_id, $logo_sticky_image_attr );

			$parameters['logo_sticky_image'] = $image_html;
		}

		if ( ! empty( $logo_main_image_id ) || ! empty( $logo_dark_image_id ) || ! empty( $logo_light_image_id ) || ! empty( $logo_sticky_image_id ) ) {
			mildhill_core_template_part( 'header/templates', 'parts/logo', $slug, $parameters );
		} else if ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}

if ( ! function_exists( 'mildhill_core_get_header_widget_area' ) ) {
	function mildhill_core_get_header_widget_area( $header_layout = '', $widget_area = 'one' ) {
		$page_id = qode_framework_get_page_id();

		$widget_area_map = apply_filters( 'mildhill_core_filter_header_widget_area', array(
			'page_id'             => $page_id,
			'header_layout'       => $header_layout,
			'is_enabled'          => get_post_meta( $page_id, 'qodef_show_header_widget_areas', true ) !== 'no',
			'default_widget_area' => 'qodef-header-widget-area-' . esc_attr( $widget_area ),
			'custom_widget_area'  => get_post_meta( $page_id, 'qodef_header_custom_widget_area_' . esc_attr( $widget_area ), true )
		) );

		extract( $widget_area_map );

		if ( $is_enabled ) {
			if ( is_active_sidebar( $default_widget_area ) && empty( $custom_widget_area ) ) {
				dynamic_sidebar( $default_widget_area );
			} else if ( ! empty( $custom_widget_area ) && is_active_sidebar( $custom_widget_area ) ) {
				dynamic_sidebar( $custom_widget_area );
			}
		}
	}
}