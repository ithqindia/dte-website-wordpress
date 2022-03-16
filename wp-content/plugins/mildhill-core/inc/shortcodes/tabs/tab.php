<?php

if ( ! function_exists( 'mildhill_core_add_tabs_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_tabs_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreTabsShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_tabs_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreTabsShortcode extends MildhillCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'mildhill_core_filter_tabs_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/tabs' );
			$this->set_base( 'mildhill_core_tabs' );
			$this->set_name( esc_html__( 'Tabs', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tabs holder', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_is_parent_shortcode( true );
			$this->set_child_elements( array(
				'mildhill_core_tabs_child'
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
				'name'          => 'orientation',
				'title'         => esc_html__( 'Orientation', 'mildhill-core' ),
				'options'       => array(
					'horizontal' => esc_html__( 'Horizontal', 'mildhill-core' ),
					'vertical'   => esc_html__( 'Vertical', 'mildhill-core' )
				),
				'default_value' => 'horizontal'
			) );
		}
		
		public function load_assets() {
			wp_enqueue_script( 'jquery-ui-tabs' );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['tabs_titles']    = $this->get_tabs_titles( $content );
			$atts['content']        = $content;
			$atts['content'] = preg_replace('/\[mildhill_core_tabs_child/i', '[mildhill_core_tabs_child layout="'.$atts['layout'].'"', $content);

			return mildhill_core_get_template_part( 'shortcodes/tabs', 'variations/'.$atts['layout'].'/templates/holder', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-tabs';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['orientation'] ) ? 'qodef-orientation--' . $atts['orientation'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_tabs_titles( $content ) {
			// Extract tab titles
			preg_match_all( '/tab_title="([^\"]+)"/i', $content, $titles, PREG_OFFSET_CAPTURE );
			$tab_titles = array();
			
			/**
			 * get tab titles array
			 */
			if ( isset( $titles[0] ) ) {
				$tab_titles = $titles[0];
			}
			
			$tab_title_array = array();
			
			foreach ( $tab_titles as $tab ) {
				preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
				$tab_title_array[] = $tab_matches[1][0];
			}
			
			return $tab_title_array;
		}
	}
}