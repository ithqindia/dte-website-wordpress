<?php

if ( ! function_exists( 'mildhill_core_add_portfolio_single_variation_slider' ) ) {
	function mildhill_core_add_portfolio_single_variation_slider( $variations ) {

		$variations['slider'] = esc_html__( 'Slider', 'mildhill-core' );

		return $variations;
	}

	add_filter( 'mildhill_core_filter_portfolio_single_layout_options', 'mildhill_core_add_portfolio_single_variation_slider' );
}

if ( ! function_exists( 'mildhill_core_add_portfolio_single_slider' ) ) {
	function mildhill_core_add_portfolio_single_slider() {
		if ( mildhill_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' ) == 'slider' ) {
			mildhill_core_template_part( 'post-types/portfolio', 'variations/slider/layout/parts/slider' );
		}
	}

	add_action( 'mildhill_action_before_page_inner', 'mildhill_core_add_portfolio_single_slider' );
}