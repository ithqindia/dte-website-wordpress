<?php

if ( ! function_exists( 'mildhill_core_add_banner_variation_type_3' ) ) {
    function mildhill_core_add_banner_variation_type_3( $variations ) {

        $variations['type-3'] = esc_html__( 'Type 3', 'mildhill-core' );

        return $variations;
    }

    add_filter( 'mildhill_core_filter_banner_layouts', 'mildhill_core_add_banner_variation_type_3' );
}
