<?php

if ( ! function_exists( 'mildhill_is_side_area_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function mildhill_is_side_area_enabled() {
		$is_enabled = is_active_widget( false, false, 'mildhill_core_side_area_opener' );

		return apply_filters( 'mildhill_filter_enable_side_area', $is_enabled );
	}
}

if ( ! function_exists( 'mildhill_core_enqueue_side_area_assets' ) ) {
	/**
	 * Function that enqueue 3rd party plugins script
	 */
	function mildhill_core_enqueue_side_area_assets() {

		if ( mildhill_is_side_area_enabled() ) {
			wp_enqueue_style( 'perfect-scrollbar', MILDHILL_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
			wp_enqueue_script( 'perfect-scrollbar', MILDHILL_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		}
	}

	add_action( 'mildhill_core_action_before_main_css', 'mildhill_core_enqueue_side_area_assets' );
}

if ( ! function_exists( 'mildhill_core_load_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function mildhill_core_load_side_area() {

		if ( mildhill_is_side_area_enabled() ) {
			$parameters = array(
				'classes' => mildhill_core_side_area_classes()
			);

			mildhill_core_template_part( 'side-area', 'templates/side-area', '', $parameters );
		}
	}

	add_action( 'mildhill_action_before_wrapper_close_tag', 'mildhill_core_load_side_area', 10 );
}

if ( ! function_exists( 'mildhill_core_side_area_classes' ) ) {
	function mildhill_core_side_area_classes() {
		$classes = array();

		$alignment = mildhill_core_get_option_value( 'admin', 'qodef_side_area_alignment' );

		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-content-alignment-' . $alignment;
		}

		return $classes;
	}
}

if ( ! function_exists( 'mildhill_core_get_side_area_config' ) ) {
	/**
	 * Function that return config variables for side area
	 *
	 * @return array
	 */
	function mildhill_core_get_side_area_config() {

		// Config variables
		$config = apply_filters( 'mildhill_core_filter_side_area_config', array(
			'title_tag'   => 'h6',
			'title_class' => 'qodef-widget-title'
		) );

		return $config;
	}
}

if ( ! function_exists( 'mildhill_core_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function mildhill_core_register_side_area_sidebar() {

		// Sidebar config variables
		$config = mildhill_core_get_side_area_config();

		register_sidebar(
			array(
				'id'            => 'qodef-side-area',
				'name'          => esc_html__( 'Side Area', 'mildhill-core' ),
				'description'   => esc_html__( 'Widgets added here will appear in side area', 'mildhill-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="side-area">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
				'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>'
			)
		);
	}

	add_action( 'widgets_init', 'mildhill_core_register_side_area_sidebar' );
}

if ( ! function_exists( 'mildhill_core_include_side_area_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function mildhill_core_include_side_area_widget() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/side-area/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'mildhill_core_include_side_area_widget' );
}

if ( ! function_exists( 'mildhill_core_get_side_area_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function mildhill_core_get_side_area_icon_html( $is_close_icon = false ) {
		$html = '';

		$icon_source         = mildhill_core_get_option_value( 'admin', 'qodef_side_area_icon_source' );
		$icon_pack           = mildhill_core_get_option_value( 'admin', 'qodef_side_area_icon_pack' );
		$icon_svg_path       = mildhill_core_get_option_value( 'admin', 'qodef_side_area_icon_svg_path' );
		$close_icon_svg_path = mildhill_core_get_option_value( 'admin', 'qodef_side_area_close_icon_svg_path' );

		if ( $icon_source === 'icon_pack' && ! empty( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack );
			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'menu', $icon_pack );
			}
		} else if ( $icon_source === 'svg_path' && ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) ) {
			if ( $is_close_icon ) {
				$html .= $close_icon_svg_path;
			} else {
				$html .= $icon_svg_path;
			}
		} else if ( $icon_source === 'predefined' ) {
			if ( $is_close_icon ) {
				$html .= mildhill_core_get_svg( 'close' );
			} else {
				$html .= mildhill_core_get_svg( 'sidearea' );
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'mildhill_core_side_area_set_icon_styles' ) ) {
	/**
	 * Function that generates icon styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_side_area_set_icon_styles( $style ) {
		$close_icon_style       = array();
		$close_icon_hover_style = array();

		$close_icon_color       = mildhill_core_get_option_value( 'admin', 'qodef_side_area_close_icon_color' );
		$close_icon_hover_color = mildhill_core_get_option_value( 'admin', 'qodef_side_area_close_icon_hover_color' );

		if ( ! empty( $close_icon_color ) ) {
			$close_icon_style['color'] = $close_icon_color;
		}

		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_style['color'] = $close_icon_hover_color;
		}

		if ( ! empty( $close_icon_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-close', $close_icon_style );
		}

		if ( ! empty( $close_icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-close:hover', $close_icon_hover_style );
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_side_area_set_icon_styles' );
}

if ( ! function_exists( 'mildhill_core_set_side_area_styles' ) ) {
	/**
	 * Function that generates page side area inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_set_side_area_styles( $style ) {
		$side_area_inner_styles = array();
		$side_area_styles       = array();
		$side_area_cover_styles = array();

		$side_area_inner_background_color = mildhill_core_get_post_value_through_levels( 'qodef_side_area_background_color' );

		$side_area_background_image = mildhill_core_get_svg( 'ripped-line-vertical-left', '#ffffff' );
		$side_area_width            = mildhill_core_get_post_value_through_levels( 'qodef_side_area_width' );

		$side_area_cover_background_color = mildhill_core_get_post_value_through_levels( 'qodef_side_area_content_overlay_color' );

		if ( ! empty( $side_area_inner_background_color ) ) {
			$side_area_inner_styles['background-color'] = $side_area_inner_background_color;
			$side_area_background_image                 = mildhill_core_get_svg( 'ripped-line-vertical-left', $side_area_inner_background_color );
		}

		if ( ! empty( $side_area_background_image ) ) {
			$side_area_styles['background-image'] = 'url(data:image/svg+xml;base64,' . base64_encode( $side_area_background_image ) . ')';
		}

		if ( ! empty( $side_area_width ) ) {
			if ( qode_framework_string_ends_with( $side_area_width, '%' ) || qode_framework_string_ends_with( $side_area_width, 'px' ) ) {
				$side_area_styles['width'] = $side_area_width;
				$side_area_styles['right'] = '-' . $side_area_width;
			} else {
				$side_area_styles['width'] = intval( $side_area_width ) . 'px';
				$side_area_styles['right'] = '-' . intval( $side_area_width ) . 'px';
			}
		}

		if ( ! empty( $side_area_cover_background_color ) ) {
			$side_area_cover_styles['background-color'] = $side_area_cover_background_color;
		}

		if ( ! empty( $side_area_inner_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-inner', $side_area_inner_styles );
		}

		if ( ! empty( $side_area_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area', $side_area_styles );
		}

		if ( ! empty( $side_area_cover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area--opened .qodef-side-area-cover', $side_area_cover_styles );
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_set_side_area_styles' );
}