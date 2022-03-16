<?php

if ( ! function_exists( 'mildhill_core_add_accordion_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_accordion_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreAccordionShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_accordion_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreAccordionShortcode extends MildhillCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'mildhill_core_filter_accordion_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/accordion' );
			$this->set_base( 'mildhill_core_accordion' );
			$this->set_name( esc_html__( 'Accordion', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds accordion holder', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_is_parent_shortcode( true );
			$this->set_child_elements( array(
				'mildhill_core_accordion_child'
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
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'behavior',
				'title'         => esc_html__( 'Behavior', 'mildhill-core' ),
				'options'       => array(
					'accordion' => esc_html__( 'Accordion', 'mildhill-core' ),
					'toggle'    => esc_html__( 'Toggle', 'mildhill-core' )
				),
				'default_value' => 'accordion'
			) );
		}
		
		public function load_assets() {
			wp_enqueue_script( 'jquery-ui-accordion' );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['content'] = preg_replace('/\[mildhill_core_accordion_child/i', '[mildhill_core_accordion_child layout="'.$atts['layout'].'"', $content);
			
			return mildhill_core_get_template_part( 'shortcodes/accordion', 'variations/'.$atts['layout'].'/templates/holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-accordion';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['behavior'] ) ? 'qodef-behavior--' . $atts['behavior'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}