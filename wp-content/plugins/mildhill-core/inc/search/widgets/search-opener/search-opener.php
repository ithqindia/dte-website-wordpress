<?php

if ( ! function_exists( 'mildhill_core_add_search_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 **/
	function mildhill_core_add_search_opener_widget( $widgets ) {
		$widgets[] = 'MildhillCoreSearchOpener';

		return $widgets;
	}

	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_search_opener_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreSearchOpener extends QodeFrameworkWidget {

		//public function __construct() {
		//	add_filter( 'mildhill_filter_add_inline_style', array( $this, 'set_inline_search_opener_styles' ) );
		//	parent::__construct();
		//}

		public function map_widget() {
			$this->set_base( 'mildhill_core_search_opener' );
			$this->set_name( esc_html__( 'Mildhill Search Opener', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Display a "search" icon that opens the search form', 'mildhill-core' ) );

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'search_opener_size',
					'title'      => esc_html__( 'Search Opener Size (px)', 'mildhill-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'search_opener_margin',
					'title'       => esc_html__( 'Search Opener Margin', 'mildhill-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'mildhill-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'search_opener_color',
					'title'      => esc_html__( 'Search Opener Color', 'mildhill-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'search_opener_hover_color',
					'title'      => esc_html__( 'Search Opener Hover Color', 'mildhill-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'search_opener_label',
					'title'      => esc_html__( 'Enable Search Opener Label', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'no_yes', false )
				)
			);
		}

		public function render( $atts ) {
			$styles = array();

			if ( ! empty( $atts['search_icon_size'] ) ) {
				if ( qode_framework_string_ends_with( $atts['side_area_opener_icon_size'], 'px' ) ) {
					$px = '';
				} else {
					$px = 'px';
				}
				$styles[] = 'font-size:' . $atts['search_opener_size'] . $px;
				$styles[] = 'height:' . $atts['search_opener_size'] . $px; // to control svg height
			}

			if ( ! empty( $atts['search_opener_color'] ) ) {
				$styles[] = 'color: ' . $atts['search_opener_color'] . ';';
			}

			if ( ! empty( $atts['search_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['search_opener_margin'];
			}
			?>

            <a href="#"
               class="qodef-search-opener qodef-opener-widget <?php echo mildhill_core_get_open_close_icon_class( 'qodef_search_icon_source', 'qodef-opener-widget' ); ?>"
				<?php qode_framework_inline_attr( $atts['search_opener_hover_color'], 'data-hover-color' ); ?>
				<?php qode_framework_inline_style( $styles ); ?> >

                <span class="qodef-m-icon">
			    	<?php echo mildhill_core_get_search_icon_html(); ?>
                </span>

				<?php if ( $atts['search_opener_label'] === 'yes' ) : ?>
                    <span class="qodef-m-label">
                        <?php esc_html_e( 'Search', 'mildhill-core' ); ?>
                    </span>
				<?php endif; ?>

            </a>

			<?php
		}
	}
}