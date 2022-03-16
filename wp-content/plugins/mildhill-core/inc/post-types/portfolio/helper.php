<?php

if ( ! function_exists( 'mildhill_core_generate_portfolio_single_layout' ) ) {
	function mildhill_core_generate_portfolio_single_layout() {
		$portfolio_template = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );
		$portfolio_template = ! empty( $portfolio_template ) ? $portfolio_template : '';

		return $portfolio_template;
	}

	add_filter( 'mildhill_core_filter_portfolio_single_layout', 'mildhill_core_generate_portfolio_single_layout' );
}

if ( ! function_exists( 'mildhill_core_get_portfolio_holder_classes' ) ) {
	/**
	 * Function that return classes for the main portfolio holder
	 *
	 * @return string
	 */
	function mildhill_core_get_portfolio_holder_classes() {
		$classes = array( 'qodef-portfolio-single' );

		$item_layout = mildhill_core_generate_portfolio_single_layout();
		if ( ! empty( $item_layout ) ) {
			$classes[] = 'qodef-item-layout--' . $item_layout;
		}

		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'mildhill_core_set_portfolio_single_body_classes' ) ) {
	/**
	 * Function that return classes for the portfolio single
	 *
	 * @return array $classes
	 */
	function mildhill_core_set_portfolio_single_body_classes( $classes ) {
		$item_layout = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( is_singular( 'portfolio-item' ) && ! empty( $item_layout ) ) {
			$classes[] = 'qodef-portfolio-single-layout--' . $item_layout;
		}

		return $classes;
	}

	add_filter( 'body_class', 'mildhill_core_set_portfolio_single_body_classes' );
}

if ( ! function_exists( 'mildhill_core_generate_portfolio_archive_with_shortcode' ) ) {
	/**
	 * Function that executes portfolio list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 *
	 */
	function mildhill_core_generate_portfolio_archive_with_shortcode( $tax, $tax_slug ) {
		$params = array();

		$params['additional_params']         = 'tax';
		$params['tax']                       = $tax;
		$params['tax_slug']                  = $tax_slug;
		$params['layout']                    = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_item_layout' );
		$params['behavior']                  = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_behavior' );
		$params['masonry_images_proportion'] = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_masonry_images_proportion' );
		$params['columns']                   = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns' );
		$params['space']                     = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_space' );
		$params['columns_responsive']        = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_responsive' );
		$params['columns_1440']              = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_1440' );
		$params['columns_1366']              = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_1366' );
		$params['columns_1024']              = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_1024' );
		$params['columns_768']               = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_768' );
		$params['columns_680']               = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_680' );
		$params['columns_480']               = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_480' );
		$params['slider_loop']               = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_slider_loop' );
		$params['slider_autoplay']           = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_slider_autoplay' );
		$params['slider_speed']              = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_slider_speed' );
		$params['slider_navigation']         = mildhill_core_get_post_value_through_levels( 'navigation' );
		$params['slider_pagination']         = mildhill_core_get_post_value_through_levels( 'pagination' );
		$params['pagination_type']           = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_pagination_type' );

		echo MildhillCorePortfolioListShortcode::call_shortcode( $params );
	}
}

if ( ! function_exists( 'mildhill_core_is_portfolio_title_enabled' ) ) {
	function mildhill_core_is_portfolio_title_enabled( $is_enabled ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$portfolio_title = mildhill_core_get_post_value_through_levels( 'qodef_enable_portfolio_title' );
			$is_enabled      = $portfolio_title == '' ? $is_enabled : ( $portfolio_title == 'no' ? false : true );
		}

		return $is_enabled;
	}

	add_filter( 'mildhill_core_filter_is_page_title_enabled', 'mildhill_core_is_portfolio_title_enabled' );
}

if ( ! function_exists( 'mildhill_core_portfolio_title_grid' ) ) {
	function mildhill_core_portfolio_title_grid( $enable_title_grid ) {
		if ( is_singular( 'portfolio-item' ) ) {
			$portfolio_title_grid = mildhill_core_get_post_value_through_levels( 'qodef_set_portfolio_title_area_in_grid' );
			$enable_title_grid    = $portfolio_title_grid == '' ? $enable_title_grid : ( $portfolio_title_grid == 'no' ? false : true );
		}

		return $enable_title_grid;
	}

	add_filter( 'mildhill_core_filter_page_title_in_grid', 'mildhill_core_portfolio_title_grid' );
}

if ( ! function_exists( 'mildhill_core_portfolio_breadcrumbs_title' ) ) {
	function mildhill_core_portfolio_breadcrumbs_title( $wrap_child, $settings ) {
		if ( is_tax( 'portfolio-category' ) ) {
			$wrap_child = '';
			$category   = get_term( get_queried_object_id(), 'portfolio-category' );

			if ( isset( $category->parent ) && $category->parent !== 0 ) {
				$parent     = get_term( $category->parent );
				$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name . $settings['separator'] );
			}

			$wrap_child .= sprintf( $settings['current_item'], single_cat_title( '', false ) );
		} else if ( is_singular( 'portfolio-item' ) ) {
			$wrap_child = '';
			$categories = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

			if ( ! empty ( $categories ) ) {
				$category = $categories[0];
				if ( isset( $category->parent ) && $category->parent !== 0 ) {
					$parent     = get_term( $category->parent );
					$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name . $settings['separator'] );
				}
				$wrap_child .= sprintf( $settings['link'], get_term_link( $category ), $category->name . $settings['separator'] );
			}

			$wrap_child .= sprintf( $settings['current_item'], get_the_title() );
		}

		return $wrap_child;
	}

	add_filter( 'mildhill_core_filter_breadcrumbs_content', 'mildhill_core_portfolio_breadcrumbs_title', 10, 2 );
}

if ( ! function_exists( 'mildhill_core_set_portfolio_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function mildhill_core_set_portfolio_custom_sidebar_name( $sidebar_name ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_custom_sidebar' );
		} else if ( is_tax() ) {
			$taxonomies = get_object_taxonomies( 'portfolio-item' );
			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$option = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_custom_sidebar' );
				}
			}
		}

		if ( isset( $option ) && ! empty( $option ) ) {
			$sidebar_name = $option;
		}

		return $sidebar_name;
	}

	add_filter( 'mildhill_filter_sidebar_name', 'mildhill_core_set_portfolio_custom_sidebar_name' );
}

if ( ! function_exists( 'mildhill_core_set_portfolio_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function mildhill_core_set_portfolio_sidebar_layout( $layout ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_sidebar_layout' );
		} else if ( is_tax() ) {
			$taxonomies = get_object_taxonomies( 'portfolio-item' );
			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$option = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_sidebar_layout' );
				}
			}
		}

		if ( isset( $option ) && ! empty( $option ) ) {
			$layout = $option;
		}

		return $layout;
	}

	add_filter( 'mildhill_filter_sidebar_layout', 'mildhill_core_set_portfolio_sidebar_layout' );
}

if ( ! function_exists( 'mildhill_core_set_portfolio_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_portfolio_sidebar_grid_gutter_classes( $classes ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_sidebar_grid_gutter' );
		} else if ( is_tax() ) {
			$taxonomies = get_object_taxonomies( 'portfolio-item' );
			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$option = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_archive_sidebar_grid_gutter' );
				}
			}
		}
		if ( isset( $option ) && ! empty( $option ) ) {
			$classes = 'qodef-gutter--' . esc_attr( $option );
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_grid_gutter_classes', 'mildhill_core_set_portfolio_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'mildhill_core_portfolio_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param $position int
	 * @param $map string
	 *
	 * @return int
	 */
	function mildhill_core_portfolio_set_admin_options_map_position( $position, $map ) {

		if ( $map === 'portfolio' ) {
			$position = 50;
		}

		return $position;
	}

	add_filter( 'mildhill_core_filter_admin_options_map_position', 'mildhill_core_portfolio_set_admin_options_map_position', 10, 2 );
}


if ( ! function_exists( 'mildhill_core_set_portfolio_single_info_follow_body_class' ) ) {
	/**
	 * Function that set on body classes for sticky info
	 *
	 * @param $position int
	 * @param $map string
	 *
	 * @return int
	 */
	function mildhill_core_set_portfolio_single_info_follow_body_class( $classes ) {
		$info_follow = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_sticky_info' );

		if ( is_singular( 'portfolio-item' ) && $info_follow === 'yes' ) {
			$classes[] = 'qodef-follow-portfolio-info';
		}

		return $classes;
	}

	add_filter( 'body_class', 'mildhill_core_set_portfolio_single_info_follow_body_class' );
}
