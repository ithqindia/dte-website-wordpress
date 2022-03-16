<?php
if ( ! function_exists( 'mildhill_core_register_covers_header_search_layout' ) ) {
	function mildhill_core_register_covers_header_search_layout( $search_layouts ) {
		$search_layout = array(
			'covers-header' => 'CoversHeaderSearch'
		);

		$search_layouts = array_merge( $search_layouts, $search_layout );

		return $search_layouts;
	}

	add_filter( 'mildhill_core_filter_register_search_layouts', 'mildhill_core_register_covers_header_search_layout');
}

if(! function_exists( 'mildhill_core_set_fixed_header_height' )){
    function mildhill_core_set_fixed_header_height($style){
        $fixed_header_height_style = array();

        $option_header_height = mildhill_core_get_post_value_through_levels('qodef_standard_header_height');
        $option_top_bar_height = mildhill_core_get_post_value_through_levels( 'qodef_top_area_header_height');

        $top_bar_height = ! empty( $option_top_bar_height ) ? $option_top_bar_height : 47;
        $header_height  = ! empty( $option_header_height ) ? $option_header_height : 105;


        if(!empty($header_height) & !empty($top_bar_height)){
            $fixed_header_height_style['height'] = intval($header_height) + intval($top_bar_height) . 'px' ;
        }

        if ( ! empty( $fixed_header_height_style ) ) {
            $style .= qode_framework_dynamic_style( '.qodef-header--fixed-display .qodef-search-cover', $fixed_header_height_style );
        }

        return $style;
    }

    add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_set_fixed_header_height' );
}