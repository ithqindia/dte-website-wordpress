<?php

if ( ! function_exists( 'mildhill_core_add_instagram_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_instagram_list_widget( $widgets ) {
		$widgets[] = 'MildhillCoreInstagramListWidget';
		
		return $widgets;
	}
	
	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_instagram_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreInstagramListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'mildhill-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'mildhill_core_instagram_list'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'mildhill_core_instagram_list' );
				$this->set_name( esc_html__( 'Mildhill Instagram List', 'mildhill-core' ) );
				$this->set_description( esc_html__( 'Add a instagram list element into widget areas', 'mildhill-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[mildhill_core_instagram_list $params]" ); // XSS OK
		}
	}
}