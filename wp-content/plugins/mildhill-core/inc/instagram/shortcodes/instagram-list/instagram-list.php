<?php

if ( ! function_exists( 'mildhill_core_add_instagram_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function mildhill_core_add_instagram_list_shortcode( $shortcodes ) {
		if ( qode_framework_is_installed( 'instagram' ) ) {
			$shortcodes[] = 'MildhillCoreInstagramListShortcode';
		}

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_instagram_list_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreInstagramListShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_INC_URL_PATH . '/instagram/shortcodes/instagram-list' );
			$this->set_base( 'mildhill_core_instagram_list' );
			$this->set_name( esc_html__( 'Instagram List', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays instagram list', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'photos_number',
				'title'      => esc_html__( 'Number of Photos', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_number',
				'title'         => esc_html__( 'Number of Columns', 'mildhill-core' ),
				//'options'       => array(
				//	'1'  => esc_html__( '1', 'mildhill-core' ),
				//	'2'  => esc_html__( '2', 'mildhill-core' ),
				//	'3'  => esc_html__( '3', 'mildhill-core' ),
				//	'4'  => esc_html__( '4', 'mildhill-core' ),
				//	'5'  => esc_html__( '5', 'mildhill-core' ),
				//	'6'  => esc_html__( '6', 'mildhill-core' ),
				//	'7'  => esc_html__( '7', 'mildhill-core' ),
				//	'8'  => esc_html__( '8', 'mildhill-core' ),
				//	'9'  => esc_html__( '9', 'mildhill-core' ),
				//	'10' => esc_html__( '10', 'mildhill-core' ),
				//),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'space',
				'title'         => esc_html__( 'Padding Around Images', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'items_space' ),
				'default_value' => 'small'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_resolution',
				'title'         => esc_html__( 'Image Resolution', 'mildhill-core' ),
				'options'       => array(
					'auto'   => esc_html__( 'Auto-detect (recommended)', 'mildhill-core' ),
					'thumb'  => esc_html__( 'Thumbnail (150x150)', 'mildhill-core' ),
					'medium' => esc_html__( 'Medium (306x306)', 'mildhill-core' ),
					'full'   => esc_html__( 'Full (640x640)', 'mildhill-core' )
				),
				'default_value' => 'auto'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_responsive',
				'title'         => esc_html__( 'Columns Responsive', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_responsive' ),
				'default_value' => 'predefined'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1440',
				'title'         => esc_html__( 'Columns Number 1367px - 1440px', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1366',
				'title'         => esc_html__( 'Columns Number 1025px - 1366px', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_1024',
				'title'         => esc_html__( 'Columns Number 769px - 1024px', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_768',
				'title'         => esc_html__( 'Columns Number 681px - 768px', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_680',
				'title'         => esc_html__( 'Columns Number 481px - 680px', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_480',
				'title'         => esc_html__( 'Columns Number 0 - 480px', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'columns_number' ),
				'default_value' => '3',
				'dependency'    => array(
					'show' => array(
						'columns_responsive' => array(
							'values'        => 'custom',
							'default_value' => '3'
						)
					)
				),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'content_padding',
				'title'      => esc_html__( 'Content Padding', 'mildhill-core' ),
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes']   = $this->get_holder_classes( $atts );
			$atts['instagram_params'] = $this->get_instagram_params( $atts );
			$atts['content_styles']   = $this->get_content_styles( $atts );

			return mildhill_core_get_template_part( 'instagram/shortcodes/instagram-list', 'templates/instagram-list', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-instagram-list qodef-layout--columns';
			$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
			$holder_classes[] = ! empty( $atts['columns_number'] ) ? 'qodef-col-num--' . $atts['columns_number'] : '';

			if ( ! empty( $atts['columns_responsive'] ) && $atts['columns_responsive'] === 'custom' ) {
				$holder_classes[] = 'qodef-responsive--custom';
				$holder_classes[] = ! empty( $atts['columns_1440'] ) ? 'qodef-col-num--1440--' . $atts['columns_1440'] : 'qodef-col-num--1440--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_1366'] ) ? 'qodef-col-num--1366--' . $atts['columns_1366'] : 'qodef-col-num--1366--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_1024'] ) ? 'qodef-col-num--1024--' . $atts['columns_1024'] : 'qodef-col-num--1024--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_768'] ) ? 'qodef-col-num--768--' . $atts['columns_768'] : 'qodef-col-num--768--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_680'] ) ? 'qodef-col-num--680--' . $atts['columns_680'] : 'qodef-col-num--680--' . $atts['columns'];
				$holder_classes[] = ! empty( $atts['columns_480'] ) ? 'qodef-col-num--480--' . $atts['columns_480'] : 'qodef-col-num--480--' . $atts['columns'];
			} else {
				$holder_classes[] = 'qodef-responsive--predefined';
			}

			$holder_classes = array_merge( $holder_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_content_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['content_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['content_padding'];
			}

			return $styles;
		}

		private function get_instagram_params( $atts ) {
			$params = array();

			$params['num']              = isset( $atts['photos_number'] ) && ! empty( $atts['photos_number'] ) ? $atts['photos_number'] : 6;
			$params['cols']             = isset( $atts['columns_number'] ) && ! empty( $atts['columns_number'] ) ? $atts['columns_number'] : 3;
			$params['imagepadding']     = isset( $atts['space'] ) && ! empty( $atts['space'] ) ? mildhill_core_get_space_value( $atts['space'] ) : 10;
			$params['imagepaddingunit'] = 'px';
			$params['showheader']       = false;
			$params['showfollow']       = false;
			$params['showbutton']       = false;
			$params['imageres']         = isset( $atts['image_resolution'] ) && ! empty( $atts['image_resolution'] ) ? $atts['image_resolution'] : 'auto';

			if ( is_array( $params ) && count( $params ) ) {
				foreach ( $params as $key => $value ) {
					if ( $value !== '' ) {
						$params[] = $key . "='" . esc_attr( str_replace( ' ', '', $value ) ) . "'";
					}
				}
			}

			return implode( ' ', $params );
		}
	}
}