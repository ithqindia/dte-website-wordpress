<?php
if ( ! function_exists( 'mildhill_core_is_map_enabled' ) ) {
    function mildhill_core_is_map_enabled() {
        return mildhill_core_get_post_value_through_levels( 'qodef_enable_map' ) === 'yes';
    }
}


if (!function_exists('mildhill_core_add_map_before_content')){
    function mildhill_core_add_map_before_content(){

        if (mildhill_core_is_map_enabled()) {
            $map_address1 = mildhill_core_get_post_value_through_levels('qodef_map_address_1');
            $map_address2 = mildhill_core_get_post_value_through_levels('qodef_map_address_2');
            $map_address3 = mildhill_core_get_post_value_through_levels('qodef_map_address_3');
            $map_address4 = mildhill_core_get_post_value_through_levels('qodef_map_address_4');
            $map_height = mildhill_core_get_post_value_through_levels('qodef_map_height');
            $map_zoom = mildhill_core_get_post_value_through_levels('qodef_map_zoom');
            $map_pin = mildhill_core_get_post_value_through_levels('qodef_map_pin');

            $params = array();
            $params['address1'] = $map_address1;
            $params['address2'] = $map_address2;
            $params['address3'] = $map_address3;
            $params['address4'] = $map_address4;
            $params['map_height'] = $map_height;
            $params['map_zoom'] = $map_zoom;
            $params['pin'] = $map_pin;

            echo MildhillCoreGoogleMapShortcode::call_shortcode($params);
        }
    }
    add_action('mildhill_action_before_page_inner', 'mildhill_core_add_map_before_content');
}