<?php

if ( ! function_exists( 'mildhill_core_add_team_variation_info_below' ) ) {
    function mildhill_core_add_team_variation_info_below( $variations ) {



        $variations['info-below'] = esc_html__( 'Info below', 'mildhill-core' );

        return $variations;
    }

    add_filter( 'mildhill_core_filter_team_layouts', 'mildhill_core_add_team_variation_info_below' );
}
