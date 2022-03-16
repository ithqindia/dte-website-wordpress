<?php

if ( ! function_exists( 'mildhill_core_include_blog_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function mildhill_core_include_blog_shortcodes() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/blog/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'mildhill_core_include_blog_shortcodes' );
}

if ( ! function_exists( 'mildhill_core_include_blog_shortcodes_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function mildhill_core_include_blog_shortcodes_widget() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/blog/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'mildhill_core_include_blog_shortcodes_widget' );
}

if ( ! function_exists( 'mildhill_core_set_blog_single_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function mildhill_core_set_blog_single_page_title( $enable_page_title ) {
		if ( is_singular( 'post' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_enable_page_title' ) !== 'no';

			if ( isset ( $option ) ) {
				$enable_page_title = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_enable_page_title', true );

			if ( ! empty( $meta_option ) ) {
				$enable_page_title = $meta_option;
			}
		}

		return $enable_page_title;
	}

	add_filter( 'mildhill_filter_enable_page_title', 'mildhill_core_set_blog_single_page_title' );
}

if ( ! function_exists( 'mildhill_core_set_blog_single_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function mildhill_core_set_blog_single_sidebar_layout( $layout ) {

		if ( is_singular( 'post' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_layout', true );

			if ( ! empty( $meta_option ) ) {
				$layout = $meta_option;
			}
		}

		return $layout;
	}

	add_filter( 'mildhill_filter_sidebar_layout', 'mildhill_core_set_blog_single_sidebar_layout' );
}

if ( ! function_exists( 'mildhill_core_set_blog_single_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function mildhill_core_set_blog_single_custom_sidebar_name( $sidebar_name ) {

		if ( is_singular( 'post' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_custom_sidebar', true );

			if ( ! empty( $meta_option ) ) {
				$sidebar_name = $meta_option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'mildhill_filter_sidebar_name', 'mildhill_core_set_blog_single_custom_sidebar_name' );
}

if ( ! function_exists( 'mildhill_core_set_blog_single_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_blog_single_sidebar_grid_gutter_classes( $classes ) {
		if ( is_singular( 'post' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_grid_gutter', true );

			if ( ! empty( $meta_option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $meta_option );
			}
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_grid_gutter_classes', 'mildhill_core_set_blog_single_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'mildhill_core_enable_posts_order' ) ) {
	/**
	 * Function that enable page attributes options for blog single page
	 */
	function mildhill_core_enable_posts_order() {
		add_post_type_support( 'post', 'page-attributes' );
	}

	add_action( 'admin_init', 'mildhill_core_enable_posts_order' );
}

if ( ! function_exists( 'mildhill_core_set_blog_list_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param $excerpt_length int
	 *
	 * @return int
	 */
	function mildhill_core_set_blog_list_excerpt_length( $excerpt_length ) {
		$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_list_excerpt_number_of_characters' );

		if ( $option !== '' ) {
			$excerpt_length = $option;
		}

		return $excerpt_length;
	}

	add_filter( 'mildhill_filter_blog_list_excerpt_length', 'mildhill_core_set_blog_list_excerpt_length' );
}

if ( ! function_exists( 'mildhill_core_get_allowed_pages_for_blog_sidebar_layout' ) ) {
	/**
	 * Function that return pages where blog sidebar is allowed
	 *
	 * @return bool
	 */
	function mildhill_core_get_allowed_pages_for_blog_sidebar_layout() {
		return ( is_archive() || ( is_home() && is_front_page() ) ) && get_post_type() === 'post';
	}
}

if ( ! function_exists( 'mildhill_core_set_blog_archive_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function mildhill_core_set_blog_archive_sidebar_layout( $layout ) {
		if ( mildhill_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_archive_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	add_filter( 'mildhill_filter_sidebar_layout', 'mildhill_core_set_blog_archive_sidebar_layout' );
}

if ( ! function_exists( 'mildhill_core_set_blog_archive_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function mildhill_core_set_blog_archive_custom_sidebar_name( $sidebar_name ) {
		if ( mildhill_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_archive_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'mildhill_filter_sidebar_name', 'mildhill_core_set_blog_archive_custom_sidebar_name' );
}

if ( ! function_exists( 'mildhill_core_set_blog_archive_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_blog_archive_sidebar_grid_gutter_classes( $classes ) {
		if ( mildhill_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_archive_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_grid_gutter_classes', 'mildhill_core_set_blog_archive_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'mildhill_core_quote_link_styles' ) ) {
	function mildhill_core_quote_link_styles( $style ) {

		$color = ! empty( mildhill_core_get_post_value_through_levels( 'qodef_page_background_color' ) ) ? mildhill_core_get_post_value_through_levels( 'qodef_page_background_color' ) : '#ffffff';

		$quote_link_background_image     = mildhill_core_get_svg( 'quote-link', $color );
		$quote_link_styles['background'] = 'url(data:image/svg+xml;base64,' . base64_encode( $quote_link_background_image ) . ')';
		$style                           .= qode_framework_dynamic_style( '.qodef-e-svg-holder', $quote_link_styles );

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_quote_link_styles' );
}

if ( ! function_exists( 'mildhill_core_add_blog_body_classes' ) ) {
	/**
	 * function that add body classes for blog module
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function mildhill_core_add_blog_body_classes( $classes ) {
		$option = mildhill_core_get_option_value( 'admin', 'qodef_blog_general_center_content' );

		if ( $option === 'yes' ) {
			$classes[] = mildhill_core_is_back_to_top_enabled() ? 'qodef-blog--centered' : '';
		}

		return $classes;
	}

	add_filter( 'body_class', 'mildhill_core_add_blog_body_classes' );
}