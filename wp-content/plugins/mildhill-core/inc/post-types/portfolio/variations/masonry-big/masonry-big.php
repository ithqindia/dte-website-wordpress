<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_variation_masonry_big' ) ) {
	function mildhill_core_add_portfolio_single_variation_masonry_big( $variations ) {
		$variations['masonry-big'] = esc_html__( 'Masonry - Big', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_portfolio_single_layout_options', 'mildhill_core_add_portfolio_single_variation_masonry_big' );
}

if ( ! function_exists( 'mildhill_core_include_masonry_for_portfolio_single_variation_masonry_big' ) ) {
	function mildhill_core_include_masonry_for_portfolio_single_variation_masonry_big( $post_type ) {
		$portfolio_template = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( $portfolio_template === 'masonry-big' ) {
			$post_type = 'portfolio-item';
		}

		return $post_type;
	}

	add_filter( 'mildhill_filter_allowed_post_type_to_enqueue_masonry_scripts', 'mildhill_core_include_masonry_for_portfolio_single_variation_masonry_big' );
}