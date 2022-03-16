<?php

if ( ! function_exists( 'mildhill_core_add_workflow_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_workflow_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillWorkflowShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_workflow_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillWorkflowShortcode extends MildhillCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/workflow' );
			$this->set_base( 'mildhill_workflow_gallery' );
			$this->set_name( esc_html__( 'Workflow', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds workflow holder', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'line_color',
				'title'      => esc_html__( 'Line color', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Workflow Items', 'mildhill-core' ),
				'items'      => array(
					array(
						'field_type'    => 'text',
						'name'          => 'title',
						'title'         => esc_html__( 'Title', 'mildhill-core' ),
						'default_value' => ''
					),
					array(
						'field_type'    => 'text',
						'name'          => 'text',
						'title'         => esc_html__( 'Text', 'mildhill-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'image',
						'name'       => 'image',
						'title'      => esc_html__( 'Item Image', 'mildhill-core' )
					),
					array(
						'field_type' => 'color',
						'name'       => 'image_background_color',
						'title'      => esc_html__( 'Item Background color', 'mildhill-core' ),
					),
					array(
						'field_type' => 'color',
						'name'       => 'circle_background_color',
						'title'      => esc_html__( 'Circle background color', 'mildhill-core' )
					),
				)
			) );
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->getHolderClasses( $atts );
			$atts['inner_styles']   = $this->getInnerStyles( $atts );
			$atts['this_object']    = $this;
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			return mildhill_core_get_template_part( 'shortcodes/workflow', 'templates/workflow', '', $atts );
		}

		private function getHolderClasses( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-workflow';

			return implode( ' ', $holder_classes );
		}

		public function getItemAdditional( $items_atts ) {
			$additional = array();

			$additional['classes']       = 'qodef-m-workflow-image ';
			$additional['circle_styles'] = '';
			$additional['image_styles']  = '';

			$additional['classes'] .= isset( $items_atts['image_background_color'] ) ? 'qodef-has-background' : '';

			if ( ! empty( $items_atts['circle_background_color'] ) ) {
				$additional['circle_styles'] = 'background-color: ' . $items_atts['circle_background_color'];
			}

			if ( ! empty( $items_atts['image_background_color'] ) ) {
				$additional['image_styles'] = 'background-color: ' . $items_atts['image_background_color'];
			}

			return $additional;
		}

		public function getInnerStyles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['line_color'] ) ) {
				$styles['inner_styles'] = 'color: ' . $atts['line_color'];
			}

			return $styles;
		}
	}
}