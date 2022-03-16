<?php

if ( ! function_exists( 'mildhill_core_add_icon_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_icon_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreIconShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_icon_shortcode', 8 );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreIconShortcode extends MildhillCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/icon' );
			$this->set_base( 'mildhill_core_icon' );
			$this->set_name( esc_html__( 'Icon', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'	=> 'iconpack',
				'name'			=> 'main_icon',
				'title'			=> esc_html__( 'Icon', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'size',
				'title'      => esc_html__( 'Size', 'mildhill-core' ),
				'options'    => array(
					'default' => esc_html__( 'Default', 'mildhill-core' ),
					'tiny'    => esc_html__( 'Tiny', 'mildhill-core' ),
					'small'   => esc_html__( 'Small', 'mildhill-core' ),
					'medium'  => esc_html__( 'Medium', 'mildhill-core' ),
					'large'   => esc_html__( 'Large', 'mildhill-core' ),
					'huge'    => esc_html__( 'Huge', 'mildhill-core' ),
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_size',
				'title'      => esc_html__( 'Custom Size', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'icon_layout',
				'title'         => esc_html__( 'Layout', 'mildhill-core' ),
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'mildhill-core' ),
					'circle' => esc_html__( 'Circle', 'mildhill-core' ),
					'square' => esc_html__( 'Square', 'mildhill-core' )
				),
				'default_value' => 'normal'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'border_radius',
				'title'      => esc_html__( 'Border Radius', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => 'square',
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'shape_size',
				'title'      => esc_html__( 'Shape Size', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => array( 'circle', 'square' ),
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'color',
				'title'      => esc_html__( 'Icon Color', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'hover_color',
				'title'      => esc_html__( 'Icon Hover Color', 'mildhill-core' )
			) );

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'border_width',
				'title'      => esc_html__( 'Border Width', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => array( 'circle', 'square' ),
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'border_color',
				'title'      => esc_html__( 'Border Color', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => array( 'circle', 'square' ),
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'hover_border_color',
				'title'      => esc_html__( 'Border Hover Color', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => array( 'circle', 'square' ),
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_color',
				'title'      => esc_html__( 'Background Color', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => array( 'circle', 'square' ),
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'hover_background_color',
				'title'      => esc_html__( 'Background Hover Color', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_layout' => array(
							'values'        => array( 'circle', 'square' ),
							'default_value' => 'normal'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'margin',
				'title'      => esc_html__( 'Margin', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Icon Link', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Link Target', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'mildhill_core_icon', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['styles']         = $this->get_styles( $atts );
			$atts['icon_params']    = $this->generate_icon_params( $atts );
			
			return mildhill_core_get_template_part( 'shortcodes/icon', 'templates/icon', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-icon-holder';
			$holder_classes[] = ! empty( $atts['size'] ) ? 'qodef-size--' . $atts['size'] : '';
			$holder_classes[] = ! empty( $atts['icon_layout'] ) ? 'qodef-layout--' . $atts['icon_layout'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_data_attrs( $atts ) {
			$data = array();
			
			if ( ! empty( $atts['hover_color'] ) ) {
				$data['data-hover-color'] = $atts['hover_color'];
			}
			
			if ( ! empty( $atts['hover_background_color'] ) ) {
				$data['data-hover-background-color'] = $atts['hover_background_color'];
			}
			
			if ( ! empty( $atts['hover_border_color'] ) ) {
				$data['data-hover-border-color'] = $atts['hover_border_color'];
			}
			
			return $data;
		}
		
		private function get_styles( $atts ) {
			$styles = array();
			
			if ( $atts['margin'] !== '' ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}
			
			if ( $atts['icon_layout'] !== 'normal' ) {
				
				$shape_size = '';
				if ( ! empty( $atts['shape_size'] ) ) {
					$shape_size = $atts['shape_size'];
				} elseif ( ! empty( $atts['custom_size'] ) ) {
					$shape_size = $atts['custom_size'];
				}
				
				if ( ! empty( $shape_size ) ) {
					$styles[] = 'width: ' . intval( $shape_size ) . 'px';
					$styles[] = 'height: ' . intval( $shape_size ) . 'px';
					$styles[] = 'line-height: ' . intval( $shape_size ) . 'px';
				}
				
				if ( ! empty( $atts['background_color'] ) ) {
					$styles[] = 'background-color: ' . $atts['background_color'];
				}
				
				if ( ! empty( $atts['border_color'] ) && ( isset( $atts['border_width'] ) && $atts['border_width'] !== '' ) ) {
					$styles[] = 'border-style: solid';
					$styles[] = 'border-color: ' . $atts['border_color'];
					$styles[] = 'border-width: ' . intval( $atts['border_width'] ) . 'px';
				} else if ( isset( $atts['border_width'] ) && $atts['border_width'] !== '' ) {
					$styles[] = 'border-style: solid';
					$styles[] = 'border-width: ' . intval( $atts['border_width'] ) . 'px';
				} else if ( ! empty( $atts['border_color'] ) ) {
					$styles[] = 'border-color: ' . $atts['border_color'];
				}
				
				if ( $atts['icon_layout'] == 'square' ) {
					if ( isset( $atts['border_radius'] ) && $atts['border_radius'] !== '' ) {
						$styles[] = 'border-radius: ' . intval( $atts['border_radius'] ) . 'px';
					}
				}
			}
			
			return $styles;
		}
		
		private function generate_icon_params( $atts ) {
			$icon_params = array(
				'icon_attributes' => array()
			);
			
			$icon_params['icon_attributes']['style'] = $this->generate_icon_styles( $atts );
			$icon_params['icon_attributes']['class'] = 'qodef-icon qodef-e';
			
			return $icon_params;
		}
		
		private function generate_icon_styles( $atts ) {
			$icon_styles = array();
			
			if ( ! empty( $atts['color'] ) ) {
				$icon_styles[] = 'color: ' . $atts['color'];
			}
			
			if ( ( $atts['icon_layout'] !== 'normal' && ! empty( $atts['shape_size'] ) ) || ( $atts['icon_layout'] == 'normal' ) ) {
				if ( ! empty( $atts['custom_size'] ) ) {
					$icon_styles[] = 'font-size:' . intval( $atts['custom_size'] ) . 'px';
				}
			}
			
			return implode( ';', $icon_styles );
		}
	}
}