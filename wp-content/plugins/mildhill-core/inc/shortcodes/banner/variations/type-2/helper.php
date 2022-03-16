<?php

if ( ! function_exists( 'mildhill_core_add_banner_variation_type_2' ) ) {
    function mildhill_core_add_banner_variation_type_2( $variations ) {

        $variations['type-2'] = esc_html__( 'Type 2', 'mildhill-core' );

        return $variations;
    }

    add_filter( 'mildhill_core_filter_banner_layouts', 'mildhill_core_add_banner_variation_type_2' );
}
