<?php

if ( ! function_exists( 'mildhill_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'MildhillCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'mildhill_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'mildhill_core_social_share' );
				$this->set_name( esc_html__( 'Mildhill Social Share', 'mildhill-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'mildhill-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[mildhill_core_social_share $params]" ); // XSS OK
		}
	}
}