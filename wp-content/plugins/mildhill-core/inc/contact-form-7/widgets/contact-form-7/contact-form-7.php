<?php

if ( ! function_exists( 'mildhill_core_add_contact_form_7_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_contact_form_7_widget( $widgets ) {
		$widgets[] = 'MildhillCoreContactForm7Widget';

		return $widgets;
	}

	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_contact_form_7_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreContactForm7Widget extends QodeFrameworkWidget {
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'mildhill_core_contact_form'
			) );
			if ( $widget_mapped ) {
				$this->set_base( 'mildhill_core_contact_form' );
				$this->set_name( esc_html__( 'Mildhill Contact Form 7', 'mildhill-core' ) );
				$this->set_description( esc_html__( 'Add contact form 7 into widget areas', 'mildhill-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[mildhill_core_contact_form $params]" ); // XSS OK
		}
	}
}