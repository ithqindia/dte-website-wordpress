<?php

if ( ! function_exists( 'mildhill_core_add_side_area_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_side_area_opener_widget( $widgets ) {
		$widgets[] = 'MildhillCoreSideAreaOpenerWidget';

		return $widgets;
	}

	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_side_area_opener_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreSideAreaOpenerWidget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'mildhill_core_side_area_opener' );
			$this->set_name( esc_html__( 'Mildhill Side Area Opener', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Display a "hamburger" icon that opens the side area', 'mildhill-core' ) );

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'side_area_opener_icon_size',
					'title'      => esc_html__( 'Side Area Opener Size (px)', 'mildhill-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'side_area_opener_margin',
					'title'       => esc_html__( 'Side Area Opener Margin', 'mildhill-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'mildhill-core' )
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_color',
					'title'      => esc_html__( 'Side Area Opener Color', 'mildhill-core' )
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_hover_color',
					'title'      => esc_html__( 'Side Area Opener Hover Color', 'mildhill-core' )
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'side_area_opener_label',
					'title'      => esc_html__( 'Enable Side Area Opener Label', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'no_yes', false )
				)
			);

		}

		public function render( $atts ) {
			$styles = array();

			if ( ! empty( $atts['side_area_opener_icon_size'] ) ) {
				if ( qode_framework_string_ends_with( $atts['side_area_opener_icon_size'], 'px' ) ) {
					$px = '';
				} else {
					$px = 'px';
				}
				$styles[] = 'font-size:' . $atts['side_area_opener_icon_size'] . $px;
				$styles[] = 'height:' . $atts['side_area_opener_icon_size'] . $px; // to control svg height
			}

			if ( ! empty( $atts['side_area_opener_color'] ) ) {
				$styles[] = 'color: ' . $atts['side_area_opener_color'] . ';';
			}

			if ( ! empty( $atts['side_area_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['side_area_opener_margin'];
			}
			?>

            <a href="#"
                    itemprop="url"
                    class="qodef-side-area-opener qodef-opener-widget <?php echo mildhill_core_get_open_close_icon_class( 'qodef_side_area_icon_source', 'qodef-opener-widget' ); ?>"
				<?php qode_framework_inline_attr( $atts['side_area_opener_hover_color'], 'data-hover-color' ); ?>
				<?php qode_framework_inline_style( $styles ); ?> >

                <span class="qodef-m-icon">
			    	<?php echo mildhill_core_get_side_area_icon_html(); ?>
                </span>

				<?php if ( $atts['side_area_opener_label'] === 'yes' ) : ?>
                    <span class="qodef-m-label">
                        <?php esc_html_e( 'Side area', 'mildhill-core' ); ?>
                    </span>
				<?php endif; ?>

            </a>

			<?php
		}
	}
}