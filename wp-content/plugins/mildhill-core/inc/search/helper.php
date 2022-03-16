<?php

if ( ! function_exists( 'mildhill_core_search_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function mildhill_core_search_include_widgets() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/search/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'mildhill_core_search_include_widgets' );
}

if ( ! function_exists( 'mildhill_core_search_include_layout' ) ) {
	function mildhill_core_search_include_layout() {
		$header_object = MildhillCoreHeaders::get_instance()->get_header_object();

		if ( ! empty( $header_object ) ) {
			$search_layout = $header_object->search_layout;
			$layouts       = apply_filters( 'mildhill_core_filter_register_search_layouts', $header_layouts_option = array() );

			if ( ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $value ) {
					if ( $search_layout === $key ) {
						$value::get_instance();
					}
				}
			}
		}
	}

	add_action( 'wp', 'mildhill_core_search_include_layout' );
}

if ( ! function_exists( 'mildhill_core_set_search_page_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function mildhill_core_set_search_page_page_title( $enable_page_title ) {
		$option = mildhill_core_get_post_value_through_levels( 'qodef_search_page_enable_page_title' ) !== 'no';

		if ( is_search() && $option !== '' ) {
			$enable_page_title = $option;
		}

		return $enable_page_title;
	}

	add_filter( 'mildhill_filter_enable_page_title', 'mildhill_core_set_search_page_page_title' );
}

if ( ! function_exists( 'mildhill_core_set_search_page_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function mildhill_core_set_search_page_sidebar_layout( $layout ) {

		if ( is_search() ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_search_page_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	add_filter( 'mildhill_filter_sidebar_layout', 'mildhill_core_set_search_page_sidebar_layout' );
}

if ( ! function_exists( 'mildhill_core_set_search_page_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function mildhill_core_set_search_page_custom_sidebar_name( $sidebar_name ) {

		if ( is_search() ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_search_page_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'mildhill_filter_sidebar_name', 'mildhill_core_set_search_page_custom_sidebar_name' );
}

if ( ! function_exists( 'mildhill_core_set_search_page_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_search_page_sidebar_grid_gutter_classes( $classes ) {

		if ( is_search() ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_search_page_sidebar_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_grid_gutter_classes', 'mildhill_core_set_search_page_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'mildhill_core_set_search_page_post_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param $excerpt_length int
	 *
	 * @return int
	 */
	function mildhill_core_set_search_page_post_excerpt_length( $excerpt_length ) {
		$option = mildhill_core_get_post_value_through_levels( 'qodef_search_page_excerpt_number_of_characters' );

		if ( $option !== '' ) {
			$excerpt_length = $option;
		}

		return $excerpt_length;
	}

	add_filter( 'mildhill_filter_search_page_excerpt_length', 'mildhill_core_set_search_page_post_excerpt_length' );
}

if ( ! function_exists( 'mildhill_core_get_widget_sidebars' ) ) {
	/**
	 * Returns array of widget areas which contains given widget
	 * based ond is_active_widget function
	 *
	 * @param $widget_id
	 *
	 * @return array
	 */
	function mildhill_core_get_widget_sidebars( $widget_id = false ) {
		$widget_sidebars = array();

		$sidebars_widgets = wp_get_sidebars_widgets();

		if ( is_array( $sidebars_widgets ) ) {
			foreach ( $sidebars_widgets as $sidebar => $widgets ) {
				if ( 'wp_inactive_widgets' === $sidebar || 'orphaned_widgets' === substr( $sidebar, 0, 16 ) ) {
					continue;
				}

				if ( is_array( $widgets ) ) {
					foreach ( $widgets as $widget ) {
						if ( $widget_id && _get_widget_id_base( $widget ) == $widget_id ) {
							$widget_sidebars[] = $sidebar;
						}
					}
				}
			}
		}

		return $widget_sidebars;
	}
}

if ( ! function_exists( 'mildhill_core_get_search_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function mildhill_core_get_search_icon_html( $is_close_icon = false ) {
		$html = '';

		$icon_source         = mildhill_core_get_option_value( 'admin', 'qodef_search_icon_source' );
		$icon_pack           = mildhill_core_get_option_value( 'admin', 'qodef_search_icon_pack' );
		$icon_svg_path       = mildhill_core_get_option_value( 'admin', 'qodef_search_icon_svg_path' );
		$close_icon_svg_path = mildhill_core_get_option_value( 'admin', 'qodef_search_close_icon_svg_path' );

		if ( $icon_source === 'icon_pack' && isset( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack );
			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'search', $icon_pack );
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
				$html .= mildhill_core_get_svg( 'search' );
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'mildhill_core_search_set_icon_styles' ) ) {
	/**
	 * Function that generates icon styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_search_set_icon_styles( $style ) {
		$close_icon_style       = array();
		$close_icon_hover_style = array();

		$close_icon_color       = mildhill_core_get_option_value( 'admin', 'qodef_search_close_icon_color' );
		$close_icon_hover_color = mildhill_core_get_option_value( 'admin', 'qodef_close_close_icon_hover_color' );

		if ( ! empty( $close_icon_color ) ) {
			$close_icon_style['color'] = $close_icon_color;
		}

		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_style['color'] = $close_icon_hover_color;
		}

		if ( ! empty( $close_icon_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-search-close', $close_icon_style );
		}

		if ( ! empty( $close_icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-search-close:hover', $close_icon_hover_style );
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_search_set_icon_styles' );
}