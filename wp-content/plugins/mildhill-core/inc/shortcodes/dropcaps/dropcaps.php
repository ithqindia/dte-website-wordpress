<?php

if ( ! function_exists( 'mildhill_core_add_dropcaps_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_dropcaps_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreDropcapsShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_dropcaps_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreDropcapsShortcode extends MildhillCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/dropcaps' );
			$this->set_base( 'mildhill_core_dropcaps' );
			$this->set_name( esc_html__( 'Dropcaps', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays dropcaps with provided parameters', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'type',
				'title'         => esc_html__( 'Type', 'mildhill-core' ),
				'options'       => array(
					'simple' => esc_html__( 'Simple', 'mildhill-core' ),
					'circle' => esc_html__( 'Circle', 'mildhill-core' ),
					'square' => esc_html__( 'Square', 'mildhill-core' )
				),
				'default_value' => 'simple'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'letter',
				'title'      => esc_html__( 'Letter', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'letter_color',
				'title'      => esc_html__( 'Letter Color', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'letter_background_color',
				'title'      => esc_html__( 'Letter Background Color', 'mildhill-core' ),
				'dependency' => array(
					'hide' => array(
						'type' => array(
							'values'        => 'simple',
							'default_value' => 'simple'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'mildhill-core' )
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['letter_styles']  = $this->get_letter_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			
			return mildhill_core_get_template_part( 'shortcodes/dropcaps', 'templates/dropcaps', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-dropcaps';
			$holder_classes[] = ! empty( $atts['type'] ) ? 'qodef-type--' . $atts['type'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_letter_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['letter_color'] ) ) {
				$styles[] = 'color: ' . $atts['letter_color'];
			}
			
			if ( $atts['type'] !== 'simple' && ! empty( $atts['letter_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['letter_background_color'];
			}
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}
	}
}