<?php

if ( ! function_exists( 'mildhill_core_add_vertical_split_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_vertical_split_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillVerticalSplitSliderShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_vertical_split_slider_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillVerticalSplitSliderShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider' );
			$this->set_base( 'mildhill_vertical_split_slider' );
			$this->set_name( esc_html__( 'Vertical Split Slider', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds vertical split slider holder', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_breakpoint',
				'title'         => esc_html__( 'Disable on smaller screens', 'mildhill-core' ),
				'options'       => array(
					'1024' => esc_html__( 'Below 1024px', 'mildhill-core' ),
					'768'  => esc_html__( 'Below 768px', 'mildhill-core' ),
				),
				'default_value' => '1024'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Slide Items', 'mildhill-core' ),
				'items'      => array(
					array(
						'field_type' => 'select',
						'name'       => 'slide_header_style',
						'title'      => esc_html__( 'Header/Bullets Style', 'mildhill-core' ),
						'options'    => array(
							''      => esc_html__( 'Default', 'mildhill-core' ),
							'light' => esc_html__( 'Light', 'mildhill-core' ),
							'dark'  => esc_html__( 'Dark', 'mildhill-core' ),
						)
					),
					array(
						'field_type' => 'select',
						'name'       => 'slide_layout',
						'title'      => esc_html__( 'Slide Layout', 'mildhill-core' ),
						'options'    => array(
							'image-left'  => esc_html__( 'Image On Left', 'mildhill-core' ),
							'image-right' => esc_html__( 'Image On Right', 'mildhill-core' )
						),
					),
					array(
						'field_type' => 'image',
						'name'       => 'slide_image',
						'title'      => esc_html__( 'Image', 'mildhill-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'slide_content_title',
						'title'      => esc_html__( 'Title', 'mildhill-core' ),
					),
					array(
						'field_type' => 'select',
						'name'       => 'slide_content_title_tag',
						'title'      => esc_html__( 'Title Tag', 'mildhill-core' ),
						'options'    => mildhill_core_get_select_type_options_pool( 'title_tag', false ),
					),
					array(
						'field_type' => 'textarea',
						'name'       => 'slide_content_text',
						'title'      => esc_html__( 'Text', 'mildhill-core' ),
					),
					array(
						'field_type' => 'image',
						'name'       => 'slide_content_image',
						'title'      => esc_html__( 'Content Image', 'mildhill-core' )
					),

					array(
						'field_type' => 'text',
						'name'       => 'slide_content_button_link',
						'title'      => esc_html__( 'Button Link', 'mildhill-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'slide_content_button_text',
						'title'      => esc_html__( 'Button Text', 'mildhill-core' ),
					),
					array(
						'field_type' => 'select',
						'name'       => 'slide_content_button_target',
						'title'      => esc_html__( 'Button Target', 'mildhill-core' ),
						'options'    => mildhill_core_get_select_type_options_pool( 'link_target', false )
					),
				)
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['this_object']    = $this;
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			wp_enqueue_script( 'jquery-effects-core' );
			wp_enqueue_script( 'multiscroll', MILDHILL_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider/assets/js/plugins/jquery.multiscroll.min.js', array(
				'jquery',
				'jquery-effects-core'
			), false, true );
			wp_enqueue_style( 'multiscroll', MILDHILL_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider/assets/css/plugins/jquery.multiscroll.css' );

			return mildhill_core_get_template_part( 'shortcodes/vertical-split-slider', 'templates/vertical-split-slider', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-vss qodef-m';
			$holder_classes[] = ! empty ( $atts['disable_breakpoint'] ) ? 'qodef-vss--disable-below-' . $atts['disable_breakpoint'] : '';

			return implode( ' ', $holder_classes );
		}

		public function get_slide_image_styles( $slide_atts ) {
			$styles = array();

			$styles[] = ! empty( $slide_atts['slide_image'] ) ? 'background-image: url(' . wp_get_attachment_url( $slide_atts['slide_image'] ) . ')' : '';

			return $styles;
		}

		public function get_slide_data( $slide_atts ) {
			$data = array();

			$data['data-header-skin'] = ! empty( $slide_atts['slide_header_style'] ) ? $slide_atts['slide_header_style'] : '';

			return $data;
		}
	}
}