<?php

if ( ! function_exists( 'mildhill_core_add_contact_form_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function mildhill_core_add_contact_form_shortcode( $shortcodes ) {
		if ( qode_framework_is_installed( 'contact_form_7' ) ) {
			$shortcodes[] = 'MildhillCoreContactFormShortcode';
		}

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_contact_form_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreContactFormShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_INC_URL_PATH . '/contact-form-7/shortcodes/contact-form' );
			$this->set_base( 'mildhill_core_contact_form' );
			$this->set_name( esc_html__( 'Contact Form', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays contact form', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2',
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_alignment',
				'title'         => esc_html__( 'Title Alignment', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'alignment' ),
				'default_value' => 'left',
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'background_type',
				'title'      => esc_html__( 'Background type', 'mildhill-core' ),
				'options'    => array(
					'none'  => esc_html__( 'None', 'mildhill-core' ),
					'svg'   => esc_html__( 'Predefined SVG', 'mildhill-core' ),
					'image' => esc_html__( 'Image', 'mildhill-core' ),
				)
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'background_image',
				'title'      => esc_html__( 'Background Image', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'background_type' => array(
							'values' => 'image',
						),
					),
				),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'content_padding',
				'title'      => esc_html__( 'Content Padding', 'mildhill-core' ),
				'dependency' => array(
					'show' => array(
						'background_type' => array(
							'values' => array( 'svg', 'image' ),
						),
					),
				),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'form_id',
				'title'      => esc_html__( 'Select Contact Form', 'mildhill-core' ),
				'options'    => mildhill_core_get_contact_form_7_forms( false ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'form_alignment',
				'title'         => esc_html__( 'Form Alignment', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'alignment' ),
				'default_value' => 'left',
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['content_styles'] = $this->get_content_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );

			return mildhill_core_get_template_part( 'contact-form-7/shortcodes/contact-form', 'templates/contact-form', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$classes = $this->init_holder_classes();

			$classes[] = 'qodef-contact-form';
			$classes[] = ! empty( $atts['background_type'] ) ? 'qodef-has-' . $atts['background_type'] : '';
			$classes[] = ! empty( $atts['form_alignment'] ) ? 'qodef-form-align--' . $atts['form_alignment'] : '';

			$classes = array_merge( $classes );

			return implode( ' ', $classes );
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['background_image'] ) ) {
				$styles[] = 'background-image: url(' . wp_get_attachment_image_url( $atts['background_image'], 'full' ) . ')';
			}

			return $styles;
		}

		private function get_content_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['content_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['content_padding'];
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			if ( ! empty( $atts['title_alignment'] ) ) {
				$styles[] = 'text-align: ' . $atts['title_alignment'];
			}

			return $styles;
		}
	}
}
