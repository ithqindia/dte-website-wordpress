<?php
if ( ! function_exists( 'mildhill_core_add_centered_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */

	function mildhill_core_add_centered_header_global_option( $header_layout_options ) {
		$header_layout_options['centered'] = array(
			'image' => MILDHILL_CORE_HEADER_LAYOUTS_URL_PATH . '/centered/assets/img/centered-header.png',
			'label' => esc_html__( 'Centered', 'mildhill-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'mildhill_core_filter_header_layout_option', 'mildhill_core_add_centered_header_global_option' );
}


if ( ! function_exists( 'mildhill_core_register_centered_header_layout' ) ) {
	function mildhill_core_register_centered_header_layout( $header_layouts ) {
		$header_layout = array(
			'centered' => 'CenteredHeader'
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'mildhill_core_filter_register_header_layouts', 'mildhill_core_register_centered_header_layout');
}