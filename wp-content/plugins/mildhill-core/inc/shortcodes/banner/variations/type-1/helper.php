<?php

if ( ! function_exists( 'mildhill_core_add_banner_variation_type_1' ) ) {
    function mildhill_core_add_banner_variation_type_1( $variations ) {

        $variations['type-1'] = esc_html__( 'Type 1', 'mildhill-core' );

        return $variations;
    }

    add_filter( 'mildhill_core_filter_banner_layouts', 'mildhill_core_add_banner_variation_type_1' );
}
