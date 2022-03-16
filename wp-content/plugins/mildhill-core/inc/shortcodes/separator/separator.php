<?php

if ( ! function_exists( 'mildhill_core_add_separator_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_separator_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreSeparatorShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_separator_shortcode', 9 );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreSeparatorShortcode extends MildhillCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/separator' );
			$this->set_base( 'mildhill_core_separator' );
			$this->set_name( esc_html__( 'Separator', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays separator with provided parameters', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'position',
				'title'      => esc_html__( 'Position', 'mildhill-core' ),
				'options'    => array(
					''       => esc_html__( 'Default', 'mildhill-core' ),
					'center' => esc_html__( 'Center', 'mildhill-core' ),
					'left'   => esc_html__( 'Left', 'mildhill-core' ),
					'right'  => esc_html__( 'Right', 'mildhill-core' ),
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'color',
				'title'      => esc_html__( 'Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'border_style',
				'title'      => esc_html__( 'Border Style', 'mildhill-core' ),
				'options'    => mildhill_core_get_select_type_options_pool( 'border_style' ),
				'group'      => esc_html__( 'Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'width',
				'title'      => esc_html__( 'Width (px or %)', 'mildhill-core' ),
				'group'      => esc_html__( 'Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'thickness',
				'title'      => esc_html__( 'Thickness (px)', 'mildhill-core' ),
				'group'      => esc_html__( 'Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'margin_top',
				'title'      => esc_html__( 'Margin Top (px or %)', 'mildhill-core' ),
				'group'      => esc_html__( 'Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'margin_bottom',
				'title'      => esc_html__( 'Margin Bottom (px or %)', 'mildhill-core' ),
				'group'      => esc_html__( 'Style', 'mildhill-core' )
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']   = $this->get_holder_classes( $atts );
			$atts['separator_styles'] = $this->get_separator_styles( $atts );
			
			return mildhill_core_get_template_part( 'shortcodes/separator', 'templates/separator', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-separator';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['position'] ) ? 'qodef-position--' . $atts['position'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_separator_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'border-color: ' . $atts['color'];
			}
			
			if ( ! empty( $atts['border_style'] ) ) {
				$styles[] = 'border-style: ' . $atts['border_style'];
			}
			
			$width = $atts['width'];
			if ( ! empty( $width ) ) {
				if ( qode_framework_string_ends_with( $width, '%' ) || qode_framework_string_ends_with( $width, 'px' ) ) {
					$styles[] = 'width: ' . $width;
				} else {
					$styles[] = 'width: ' . intval( $width ) . 'px';
				}
			}
			
			$thickness = $atts['thickness'];
			if ( ! empty( $thickness ) ) {
				$styles[] = 'border-bottom-width: ' . intval( $thickness ) . 'px';
			}
			
			$margin_top = $atts['margin_top'];
			if ( ! empty( $margin_top ) ) {
				if ( qode_framework_string_ends_with( $margin_top, '%' ) || qode_framework_string_ends_with( $margin_top, 'px' ) ) {
					$styles[] = 'margin-top: ' . $margin_top;
				} else {
					$styles[] = 'margin-top: ' . intval( $margin_top ) . 'px';
				}
			}
			
			$margin_bottom = $atts['margin_bottom'];
			if ( ! empty( $margin_bottom ) ) {
				if ( qode_framework_string_ends_with( $margin_bottom, '%' ) || qode_framework_string_ends_with( $margin_bottom, 'px' ) ) {
					$styles[] = 'margin-bottom: ' . $margin_bottom;
				} else {
					$styles[] = 'margin-bottom: ' . intval( $margin_bottom ) . 'px';
				}
			}
			
			return implode( ';', $styles );
		}
	}
}