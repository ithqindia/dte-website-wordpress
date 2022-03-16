<?php

if ( ! function_exists( 'mildhill_core_add_icon_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_icon_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreIconWithTextShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_icon_with_text_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreIconWithTextShortcode extends MildhillCoreShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'mildhill_core_filter_icon_with_text_layouts', array() ) );

			$options_map   = mildhill_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];

			$this->set_extra_options( apply_filters( 'mildhill_core_filter_icon_with_text_extra_options', array(), $default_value ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/icon-with-text' );
			$this->set_base( 'mildhill_core_icon_with_text' );
			$this->set_name( esc_html__( 'Icon With Text', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon with text element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );

			$options_map = mildhill_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'mildhill-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'link',
				'title'         => esc_html__( 'Link', 'mildhill-core' ),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Link Target', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'holder_background_color',
				'title'      => esc_html__( 'Background Color', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'holder_padding',
				'title'      => esc_html__( 'Padding', 'mildhill-core' ),
				'dependency' => array(
					'hide' => array(
						'holder_background_color' => array(
							'values' => ''
						),
					),
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'icon_type',
				'title'         => esc_html__( 'Icon Type', 'mildhill-core' ),
				'options'       => array(
					'icon-pack'   => esc_html__( 'Icon Pack', 'mildhill-core' ),
					'custom-icon' => esc_html__( 'Custom Icon', 'mildhill-core' )
				),
				'default_value' => 'icon-pack',
				'group'         => esc_html__( 'Icon', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'custom_icon',
				'title'      => esc_html__( 'Custom Icon', 'mildhill-core' ),
				'group'      => esc_html__( 'Icon', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'icon_type' => array(
							'values'        => 'custom-icon',
							'default_value' => 'icon-pack'
						)
					)
				)
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'mildhill_core_icon',
				'exclude'           => array( 'link', 'target' ),
				'additional_params' => array(
					'group'      => esc_html__( 'Icon', 'mildhill-core' ),
					'dependency' => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'icon-pack',
								'default_value' => 'icon-pack'
							)
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3',
				'group'         => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_font_size',
				'title'      => esc_html__( 'Text Font Size', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['icon_params']    = $this->generate_icon_params( $atts );

			return mildhill_core_get_template_part( 'shortcodes/icon-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-icon-with-text';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['icon_type'] ) ? 'qodef--' . $atts['icon_type'] : '';

			$holder_classes = apply_filters( 'mildhill_core_filter_icon_with_text_variation_classes', $holder_classes, $atts );

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['holder_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['holder_background_color'];
			}

			if ( ! empty( $atts['holder_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['holder_padding'];
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( $atts['title_margin_top'] !== '' ) {
				$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function get_text_styles( $atts ) {
			$styles = array();

			if ( $atts['text_margin_top'] !== '' ) {
				$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
			}

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			if ( ! empty( $atts['text_font_size'] ) ) {
				$styles[] = 'font-size: ' . $atts['text_font_size'];
			}

			return $styles;
		}

		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'mildhill_core_icon',
				'exclude'        => array( 'link', 'target' ),
				'atts'           => $atts,
			) );

			return $params;
		}
	}
}