<?php

if ( ! function_exists( 'mildhill_core_add_team_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_team_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreTeamShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_team_shortcode' );
}

if ( class_exists( 'MildhillCoreShortcode' ) ) {
	class MildhillCoreTeamShortcode extends MildhillCoreShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'mildhill_core_filter_team_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'mildhill_core_filter_team_extra_options', array() ) );

			parent::__construct();
		}

		public $no_of_icons = 5;

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/team' );
			$this->set_base( 'mildhill_core_team' );
			$this->set_name( esc_html__( 'Team', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds team element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
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
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'name',
				'title'      => esc_html__( 'Name', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'name_tag',
				'title'         => esc_html__( 'Name Tag', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h4',
				'group'         => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'name_color',
				'title'      => esc_html__( 'Name Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'position',
				'title'      => esc_html__( 'Position', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'position_color',
				'title'      => esc_html__( 'Position Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'mildhill-core' ),
				'group'      => esc_html__( 'Content', 'mildhill-core' )
			) );
			for ( $i = 1; $i <= $this->no_of_icons; $i ++ ) {
				$this->set_option(
					array(
						'field_type' => 'iconpack',
						'name'       => 'main_icon_' . $i,
						'title'      => sprintf( esc_html__( 'Icon %s', 'mildhill-core' ), $i ),
						'group'      => esc_html__( 'Social icons', 'mildhill-core' )
					)
				);
				$this->set_option(
					array(
						'field_type' => 'text',
						'name'       => 'link_' . $i,
						'title'      => sprintf( esc_html__( 'Link %s', 'mildhill-core' ), $i ),
						'group'      => esc_html__( 'Social icons', 'mildhill-core' )
					)
				);
				$this->set_option(
					array(
						'field_type'    => 'select',
						'name'          => 'target_' . $i,
						'title'         => sprintf( esc_html__( 'Link %s Target' ), $i ),
						'options'       => mildhill_core_get_select_type_options_pool( 'link_target', false ),
						'default_value' => '_blank',
						'group'         => esc_html__( 'Social icons', 'mildhill-core' )
					)
				);
			}

			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['name_styles']     = $this->get_name_styles( $atts );
			$atts['position_styles'] = $this->get_position_styles( $atts );
			$atts['text_styles']     = $this->get_text_styles( $atts );
			$atts['icon_params']     = $this->icon_params( $atts );

			return mildhill_core_get_template_part( 'shortcodes/team', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-team';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_name_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['name_color'] ) ) {
				$styles[] = 'color: ' . $atts['name_color'];
			}

			return $styles;
		}

		private function get_position_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['position_color'] ) ) {
				$styles[] = 'color: ' . $atts['position_color'];
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

		private function icon_params( $atts ) {
			$icon_params = array();

			for ( $i = 1; $i <= $this->no_of_icons; $i ++ ) {
				$selected_icon_pack = str_replace( '-', '_', $atts[ 'main_icon_' . $i ] );

				if ( ! empty( $atts[ 'main_icon_' . $i . '_' . $selected_icon_pack ] ) ) {
					$params = array(
						'main_icon'                        => $atts[ 'main_icon_' . $i ],
						'main_icon_' . $selected_icon_pack => $atts[ 'main_icon_' . $i . '_' . $selected_icon_pack ],
						'link'                             => $atts[ 'link_' . $i ],
						'target'                           => $atts[ 'target_' . $i ],
						'custom_size'                      => '15px',
						'icon_layout'                      => 'circle',
						'shape_size'                       => '37px',
					);

					$icon_params[] = $params;
				}
			}

			return $icon_params;
		}
	}
}
