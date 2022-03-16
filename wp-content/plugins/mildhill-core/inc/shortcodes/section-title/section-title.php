<?php

if ( ! function_exists( 'mildhill_core_add_section_title_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_section_title_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreSectionTitleShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_section_title_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreSectionTitleShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/section-title' );
			$this->set_base( 'mildhill_core_section_title' );
			$this->set_name( esc_html__( 'Section Title', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds section title element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'mildhill-core' )
			) );

			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Line Break', 'mildhill-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'mildhill-core' ),
				'group'       => esc_html__( 'Title Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'mildhill-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Title Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h1',
				'group'         => esc_html__( 'Title Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Title Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Title Custom Link', 'mildhill-core' ),
				'group'      => esc_html__( 'Title Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency'    => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				),
				'group'         => esc_html__( 'Title Style', 'mildhill-core' )
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
				'group'      => esc_html__( 'Text Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_font_size',
				'title'      => esc_html__( 'Text Font Size', 'mildhill-core' ),
				'group'      => esc_html__( 'Text Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'mildhill-core' ),
				'group'      => esc_html__( 'Text Style', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'content_alignment',
				'title'      => esc_html__( 'Content Alignment', 'mildhill-core' ),
				'options'    => array(
					''       => esc_html__( 'Default', 'mildhill-core' ),
					'left'   => esc_html__( 'Left', 'mildhill-core' ),
					'center' => esc_html__( 'Center', 'mildhill-core' ),
					'right'  => esc_html__( 'Right', 'mildhill-core' )
				),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'holder_padding',
				'title'      => esc_html__( 'Holder Padding', 'mildhill-core' ),
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['holder_styles']    = $this->get_holder_styles( $atts );

			return mildhill_core_get_template_part( 'shortcodes/section-title', 'templates/section-title', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-section-title';
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';
			$holder_classes[] = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_modified_title( $atts ) {
			$title = $atts['title'];

			if ( ! empty( $title ) && ! empty( $atts['line_break_positions'] ) ) {
				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

				foreach ( $line_break_positions as $position ) {
					if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
						$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
					}
				}

				$title = implode( ' ', $split_title );
			}

			return $title;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['holder_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['holder_padding'];
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
				$styles[] = 'font-size: ' . intval( $atts['text_font_size'] ) . 'px';
			}

			return $styles;
		}
	}
}