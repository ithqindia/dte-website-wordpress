<?php

if ( ! function_exists( 'mildhill_core_add_link_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function mildhill_core_add_link_typography_options( $page ) {
		
		if ( $page ) {
			$link_tab = $page->add_tab_element( array(
				'name'        => 'tab-link',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Link Typography', 'mildhill-core' ),
				'description' => esc_html__( 'Set values for link', 'mildhill-core' )
			) );
			
			$link_typography_section = $link_tab->add_section_element(
				array(
					'name'  => 'qodef_link_typography_section',
					'title' => esc_html__( 'General Typography', 'mildhill-core' )
				)
			);
			
			$link_typography_row = $link_typography_section->add_row_element(
				array (
					'name'  => 'qodef_link_typography_row',
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_link_color',
					'title'      => esc_html__( 'Color', 'mildhill-core' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_link_hover_color',
					'title'      => esc_html__( 'Hover Color', 'mildhill-core' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_font_weight',
					'title'      => esc_html__( 'Font Weight', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_font_style',
					'title'      => esc_html__( 'Font Style', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
			
			$link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_link_hover_text_decoration',
					'title'      => esc_html__( 'Hover Text Decoration', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 4
					)
				)
			);
		}
	}
	
	add_action( 'mildhill_core_action_after_typography_options_map', 'mildhill_core_add_link_typography_options' );
}