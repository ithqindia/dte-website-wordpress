<?php

if ( ! function_exists( 'mildhill_core_add_accordion_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_accordion_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreAccordionChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_accordion_child_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreAccordionChildShortcode extends MildhillCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/accordion' );
			$this->set_base( 'mildhill_core_accordion_child' );
			$this->set_name( esc_html__( 'Accordion Child', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds accordion child to accordion holder', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'mildhill_core_accordion'
			) );
			$this->set_is_parent_shortcode( true );
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
				'default_value' => 'h3'
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'mildhill-core' ),
				'default_value' => '',
				'visibility'    => array('map_for_page_builder' => false)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			$atts['content'] = $content;

			return mildhill_core_get_template_part( 'shortcodes/accordion', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}