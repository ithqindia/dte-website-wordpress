<?php

if ( ! function_exists( 'mildhill_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'MildhillCoreBlogListWidget';

		return $widgets;
	}

	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreBlogListWidget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'mildhill-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'mildhill_core_blog_list',
				'exclude'        => array( 'columns' ),
			) );

			if ( $widget_mapped ) {
				$this->set_base( 'mildhill_core_blog_list' );
				$this->set_name( esc_html__( 'Mildhill Blog List', 'mildhill-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'mildhill-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( array_merge( $atts, array( 'columns' => 1 ) ) );

			echo do_shortcode( "[mildhill_core_blog_list $params]" ); // XSS OK
		}
	}
}
