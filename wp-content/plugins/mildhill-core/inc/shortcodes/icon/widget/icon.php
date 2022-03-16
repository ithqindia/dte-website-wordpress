<?php

if ( ! function_exists( 'mildhill_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_icon_widget( $widgets ) {
		$widgets[] = 'MildhillCoreIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreIconWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'mildhill_core_icon'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'mildhill_core_icon' );
				$this->set_name( esc_html__( 'Mildhill Icon', 'mildhill-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'mildhill-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[mildhill_core_icon $params]" ); // XSS OK
		}
	}
}
