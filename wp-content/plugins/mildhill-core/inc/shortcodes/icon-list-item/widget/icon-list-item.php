<?php

if ( ! function_exists( 'mildhill_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'MildhillCoreIconListItemWidget';
		
		return $widgets;
	}
	
	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreIconListItemWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'mildhill_core_icon_list_item',
				'exclude'   => array(
					'icon_type', 'custom_icon'
				)
			) );
			if( $widget_mapped ) {
				$this->set_base( 'mildhill_core_icon_list_item' );
				$this->set_name( esc_html__( 'Mildhill Icon List Item', 'mildhill-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'mildhill-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[mildhill_core_icon_list_item $params]" ); // XSS OK
		}
	}
}
