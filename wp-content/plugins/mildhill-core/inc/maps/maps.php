<?php

if ( ! class_exists( 'MildhillCoreMaps' ) ) {
	class MildhillCoreMaps {
		private static $instance;

		function __construct() {

			// Include google map scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'include_google_scripts' ) );

			// Load global maps variables
			add_action( 'wp_enqueue_scripts', array( $this, 'set_global_map_variables' ), 20 );

			$maps_in_admin = apply_filters( 'materds_core_filter_google_maps_in_admin', false );
			if ( $maps_in_admin ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'include_google_scripts' ) );
			}
		}

		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function include_google_scripts() {

			$google_maps_api_key          = mildhill_core_get_option_value( 'admin', 'qodef_maps_api_key' );
			$google_maps_extensions       = '';
			$google_maps_extensions_array = apply_filters( 'mildhill_core_filter_google_maps_extensions', array() );

			if ( ! empty( $google_maps_extensions_array ) ) {
				$google_maps_extensions .= '&libraries=';
				$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
			}

			if ( ! empty( $google_maps_api_key ) ) {
				wp_register_script( 'google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . $google_maps_extensions, array(), false, true );
				wp_register_script( 'mildhill-core-google-map', MILDHILL_CORE_INC_URL_PATH . '/maps/assets/js/google-map.js', array(
					'google-map-api',
					'jquery'
				), false, true );
			}
		}

		public function set_global_map_variables() {
			$map_zoom  = mildhill_core_get_post_value_through_levels( 'qodef_map_zoom' );
			$map_style = json_decode( mildhill_core_get_post_value_through_levels( 'qodef_map_style' ) );

			$js_map_variables['mapStyle']          = ! empty ( $map_style ) ? $map_style : '';
			$js_map_variables['mapZoom']           = ! empty ( $map_zoom ) ? $map_zoom : 12;
			$js_map_variables['mapScrollable']     = mildhill_core_get_post_value_through_levels( 'qodef_enable_map_scroll' ) == 'yes' ? true : false;
			$js_map_variables['mapDraggable']      = mildhill_core_get_post_value_through_levels( 'qodef_enable_map_drag' ) == 'yes' ? true : false;
			$js_map_variables['streetViewControl'] = mildhill_core_get_post_value_through_levels( 'qodef_enable_map_street_view_control' ) == 'yes' ? true : false;
			$js_map_variables['zoomControl']       = mildhill_core_get_post_value_through_levels( 'qodef_enable_map_zoom_control' ) == 'yes' ? true : false;
			$js_map_variables['mapTypeControl']    = mildhill_core_get_post_value_through_levels( 'qodef_enable_map_type_control' ) == 'yes' ? true : false;
			$js_map_variables['fullscreenControl'] = mildhill_core_get_post_value_through_levels( 'qodef_enable_map_full_screen_control' ) == 'yes' ? true : false;

			$js_map_variables = apply_filters( 'mildhill_core_filter_js_map_variables', $js_map_variables );

			wp_localize_script( 'mildhill-core-google-map', 'qodefMapsVariables', array(
				'global' => $js_map_variables
			) );
		}
	}
}

MildhillCoreMaps::get_instance();