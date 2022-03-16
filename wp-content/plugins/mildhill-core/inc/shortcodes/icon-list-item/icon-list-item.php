<?php

if ( ! function_exists( 'mildhill_core_add_icon_list_item_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_icon_list_item_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreIconListItemShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_icon_list_item_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreIconListItemShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/icon-list-item' );
			$this->set_base( 'mildhill_core_icon_list_item' );
			$this->set_name( esc_html__( 'Icon List Item', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon list item element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'item_margin_bottom',
				'title'      => esc_html__( 'Item Margin Bottom', 'mildhill-core' )
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
			//$this->set_option( array(
			//	'field_type'    => 'select',
			//	'name'          => 'icon_type',
			//	'title'         => esc_html__( 'Icon Type', 'mildhill-core' ),
			//	'options'       => array(
			//		'icon-pack'   => esc_html__( 'Icon Pack', 'mildhill-core' ),
			//		'custom-icon' => esc_html__( 'Custom Icon', 'mildhill-core' ),
			//        'bullet-icon' => esc_html__( 'Bullet Icon', 'mildhill-core' )
			//	),
			//	'default_value' => 'icon-pack'
			//) );
			//$this->set_option( array(
			//	'field_type' => 'image',
			//	'name'       => 'custom_icon',
			//	'title'      => esc_html__( 'Custom Icon', 'mildhill-core' ),
			//	'dependency' => array(
			//		'show' => array(
			//			'icon_type' => array(
			//				'values'        => 'custom-icon',
			//				'default_value' => 'icon-pack'
			//			)
			//		)
			//	)
			//) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'mildhill_core_icon',
				'exclude'           => array( 'link', 'target', 'margin' ),
				'additional_params' => array(
					'group' => esc_html__( 'Icon', 'mildhill-core' ),
					//'dependency' => array(
					//	'show' => array(
					//		'icon_type' => array(
					//			'values'        => 'icon-pack',
					//			'default_value' => 'icon-pack'
					//		)
					//	)
					//)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'mildhill-core' ),
				'group'      => esc_html__( 'Title', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h6',
				'group'         => esc_html__( 'Title', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Title', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'mildhill-core' ),
				'group'      => esc_html__( 'Title', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'text_tag',
				'title'         => esc_html__( 'Text Tag', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'var',
				'group'         => esc_html__( 'Title', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Title', 'mildhill-core' )
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['icon_params']    = $this->generate_icon_params( $atts );

			return mildhill_core_get_template_part( 'shortcodes/icon-list-item', 'templates/icon-list-item', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = array();

			$holder_classes[] = 'qodef-icon-list-item';

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( $atts['item_margin_bottom'] !== '' ) {
				$styles[] = 'margin-bottom: ' . intval( $atts['item_margin_bottom'] ) . 'px';
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
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

		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'mildhill_core_icon',
				'exclude'        => array( 'link', 'target', 'margin' ),
				'atts'           => $atts,
			) );

			return $params;
		}
	}
}