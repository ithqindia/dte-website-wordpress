<?php

if ( ! function_exists( 'mildhill_core_add_blockquote_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_blockquote_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreBlockquoteShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_blockquote_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreBlockquoteShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/blockquote' );
			$this->set_base( 'mildhill_core_blockquote' );
			$this->set_name( esc_html__( 'Blockquote', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds blockquote element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_font_size',
				'title'      => esc_html__( 'Text Font Size', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'background_type',
				'title'      => esc_html__( 'Background type', 'mildhill-core' ),
				'options'    => array(
					'no-background' => esc_html__( 'No Background', 'mildhill-core' ),
					'svg'           => esc_html__( 'Predefined SVG', 'mildhill-core' ),
				),
				'default'    => 'none'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'content_padding',
				'title'      => esc_html__( 'Content Padding', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'background_type' => array(
							'values' => 'svg',
						),
					),
				),
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['content_styles'] = $this->get_content_styles( $atts );

			return mildhill_core_get_template_part( 'shortcodes/blockquote', 'templates/blockquote', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-blockquote';
			$holder_classes[] = ! empty( $atts['background_type'] ) ? 'qodef-has-' . $atts['background_type'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_content_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['content_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['content_padding'];
			}

			return $styles;
		}


		private function get_text_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			if ( ! empty( $atts['text_font_size'] ) ) {
				$styles[] = 'font-size: ' . intval( $atts['text_font_size'] ) . 'px';
			}

			return $styles;
		}
	}
}