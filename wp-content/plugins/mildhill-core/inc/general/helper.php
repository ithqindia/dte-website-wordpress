<?php

if ( ! function_exists( 'mildhill_core_is_ripped_line_enabled' ) ) {
	function mildhill_core_is_ripped_line_enabled() {
		return mildhill_core_get_post_value_through_levels( 'qodef_enable_ripped_line_svg' ) === 'yes';
	}
}


if ( ! function_exists( 'mildhill_core_is_boxed_enabled' ) ) {
	function mildhill_core_is_boxed_enabled() {
		return mildhill_core_get_post_value_through_levels( 'qodef_boxed' ) === 'yes';
	}
}

if ( ! function_exists( 'mildhill_core_add_general_options_body_classes' ) ) {
	function mildhill_core_add_general_options_body_classes( $classes ) {
		$content_width         = mildhill_core_get_post_value_through_levels( 'qodef_content_width' );
		$content_behind_header = mildhill_core_get_post_value_through_levels( 'qodef_content_behind_header' );

		$classes[] = mildhill_core_is_boxed_enabled() ? 'qodef--boxed' : '';
		$classes[] = mildhill_core_is_ripped_line_enabled() ? 'qodef--ripped-line' : '';
		$classes[] = 'qodef-content-grid-' . $content_width;
		$classes[] = $content_behind_header == 'yes' ? 'qodef-content-behind-header' : '';

		return $classes;
	}

	add_filter( 'body_class', 'mildhill_core_add_general_options_body_classes' );
}

if ( ! function_exists( 'mildhill_core_add_boxed_wrapper_classes' ) ) {
	function mildhill_core_add_boxed_wrapper_classes( $classes ) {

		if ( mildhill_core_is_boxed_enabled() ) {
			$classes .= ' qodef-content-grid';
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_page_wrapper_classes', 'mildhill_core_add_boxed_wrapper_classes' );
}

if ( ! function_exists( 'mildhill_core_add_boxed_wrapper_outer_classes' ) ) {
	function mildhill_core_add_boxed_wrapper_outer_classes( $classes ) {

		if ( mildhill_core_is_boxed_enabled() ) {
			$classes .= 'qodef-content-grid qodef-page-wrapper-outer';
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_page_wrapper_outer_classes', 'mildhill_core_add_boxed_wrapper_outer_classes' );
}

if ( ! function_exists( 'mildhill_core_add_ripped_line_wrap_classes' ) ) {
	function mildhill_core_add_ripped_line_wrap_classes( $classes ) {

		if ( mildhill_core_is_ripped_line_enabled() ) {
			$classes .= 'qodef-page-inner-wrap';
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_page_inner_wrap_classes', 'mildhill_core_add_ripped_line_wrap_classes' );
}

if ( ! function_exists( 'mildhill_core_set_general_styles' ) ) {
	/**
	 * Function that generates general inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_set_general_styles( $style ) {
		$page_styles = array();

		$page_background_color      = mildhill_core_get_post_value_through_levels( 'qodef_page_background_color' );
		$page_background_image      = mildhill_core_get_post_value_through_levels( 'qodef_page_background_image' );
		$page_background_repeat     = mildhill_core_get_post_value_through_levels( 'qodef_page_background_repeat' );
		$page_background_size       = mildhill_core_get_post_value_through_levels( 'qodef_page_background_size' );
		$page_background_attachment = mildhill_core_get_post_value_through_levels( 'qodef_page_background_attachment' );

		if ( ! empty( $page_background_color ) ) {
			$page_styles['background-color'] = $page_background_color;
		}

		if ( ! empty( $page_background_image ) ) {
			$page_styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $page_background_image, 'full' ) ) . ')';
		}

		if ( ! empty( $page_background_repeat ) ) {
			$page_styles['background-repeat'] = $page_background_repeat;
		}

		if ( ! empty( $page_background_size ) ) {
			$page_styles['background-size'] = $page_background_size;
		}

		if ( ! empty( $page_background_attachment ) ) {
			$page_styles['background-attachment'] = $page_background_attachment;
		}

		if ( ! empty( $page_styles ) ) {
			$style .= qode_framework_dynamic_style( 'body', $page_styles );
		}

		if ( mildhill_core_is_ripped_line_enabled() ) {
			$ripped_line_style = array();

			if ( mildhill_core_is_boxed_enabled() ) {
				$background_color = mildhill_core_get_post_value_through_levels( 'qodef_boxed_background_color' );
			} else {
				$background_color = $page_background_color;
			}

			$ripped_line = mildhill_core_get_svg( 'ripped-line-horizontal', '#ffffff' );

			if ( ! empty( $background_color ) ) {
				$ripped_line = mildhill_core_get_svg( 'ripped-line-horizontal', $background_color );
			}

			if ( ! empty( $ripped_line ) ) {
				$ripped_line_style['background-image'] = 'url(data:image/svg+xml;base64,' . base64_encode( $ripped_line ) . ')';
			}

			if ( ! empty( $ripped_line_style ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--ripped-line .qodef-page-inner-wrap', $ripped_line_style );
			}
		}

		if ( mildhill_core_is_boxed_enabled() ) {
			$boxed_styles             = array();
			$boxed_styles_outer       = array();
			$boxed_styles_outer_width = array();
			$offset                   = '75';

			$boxed_background_color       = mildhill_core_get_post_value_through_levels( 'qodef_boxed_background_color' );
			$boxed_background_image_left  = mildhill_core_get_svg( 'ripped-line-vertical-left', '#ffffff' );
			$boxed_background_image_right = mildhill_core_get_svg( 'ripped-line-vertical-right', '#ffffff' );
			$content_width                = mildhill_core_get_post_value_through_levels( 'qodef_content_width' );

			if ( ! empty( $page_styles ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--boxed', $page_styles );
			}

			if ( ! empty( $boxed_background_color ) ) {
				$boxed_styles['background-color'] = $boxed_background_color;
				$boxed_background_image_left      = mildhill_core_get_svg( 'ripped-line-vertical-left', $boxed_background_color );
				$boxed_background_image_right     = mildhill_core_get_svg( 'ripped-line-vertical-right', $boxed_background_color );
			}

			if ( ! empty( $boxed_background_image_left ) && ! empty( $boxed_background_image_right ) ) {
				$boxed_styles_outer['background-image'] = 'url(data:image/svg+xml;base64,' . base64_encode( $boxed_background_image_left ) . '), url(data:image/svg+xml;base64,' . base64_encode( $boxed_background_image_right ) . ')';
				$boxed_styles_outer_width['width']      = intval( $content_width ) + intval( $offset * 2 ) . 'px';
			}

			if ( ! empty( $boxed_styles ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--boxed #qodef-page-wrapper', $boxed_styles );
			}
			if ( ! empty( $boxed_styles_outer ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--boxed .qodef-page-wrapper-outer ', $boxed_styles_outer );
			}
			if ( ! empty( $boxed_styles_outer_width ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--boxed .qodef-page-wrapper-outer ', $boxed_styles_outer_width );
			}
		}

		$page_content_style = array();

		$page_content_padding = mildhill_core_get_post_value_through_levels( 'qodef_page_content_padding' );
		if ( ! empty ( $page_content_padding ) ) {
			$page_content_style['padding'] = $page_content_padding;
		}

		if ( ! empty( $page_content_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-inner', $page_content_style );
		}

		$page_content_style_mobile = array();

		$page_content_padding_mobile = mildhill_core_get_post_value_through_levels( 'qodef_page_content_padding_mobile' );
		if ( ! empty ( $page_content_padding_mobile ) ) {
			$page_content_style_mobile['padding'] = $page_content_padding_mobile;
		}

		if ( ! empty( $page_content_style_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '#qodef-page-inner', $page_content_style_mobile, '', '1024' );
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_set_general_styles' );
}

if ( ! function_exists( 'mildhill_core_set_general_main_color_styles' ) ) {
	/**
	 * Function that generates general main color inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_set_general_main_color_styles( $style ) {
		$main_color = mildhill_core_get_post_value_through_levels( 'qodef_main_color' );

		if ( ! empty( $main_color ) ) {

			// Include main color selectors
			include_once 'main-color/main-color.php';

			$allowed_selectors = array(
				'color',
				'color_important',
				'background_color',
				'background_color_important',
				'border_color',
				'border_color_important',
				'fill_color',
				'fill_color_important',
				'stroke_color',
				'stroke_color_important',
			);

			foreach ( $allowed_selectors as $allowed_selector ) {
				$selector = $allowed_selector . '_selector';

				if ( isset( $$selector ) && ! empty( $$selector ) ) {

					if ( strpos( $selector, '_important' ) !== false ) {
						$attribute = str_replace( '_important', '', $allowed_selector );
						$color     = $main_color . '!important';
					} else {
						$attribute = $allowed_selector;
						$color     = $main_color;
					}

					$style .= qode_framework_dynamic_style( $$selector, array( str_replace( '_', '-', $attribute ) => $color ) );
				}
			}
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_set_general_main_color_styles' );
}

if ( ! function_exists( 'mildhill_core_print_custom_js' ) ) {
	/**
	 * Prints out custom js from theme options
	 */
	function mildhill_core_print_custom_js() {
		$custom_js = mildhill_core_get_post_value_through_levels( 'qodef_custom_js' );

		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'mildhill-main-js', $custom_js );
		}
	}

	add_action( 'wp_enqueue_scripts', 'mildhill_core_print_custom_js', 15 ); // Permission 15 is set in order to call a function after the main theme script initialization
}