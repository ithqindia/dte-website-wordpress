<?php

if ( ! function_exists( 'mildhill_core_add_woo_dropdown_cart_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_woo_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'MildhillCoreWooDropDownCartWidget';

		return $widgets;
	}

	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_woo_dropdown_cart_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCoreWooDropDownCartWidget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'mildhill_core_woo_dropdown_cart' );
			$this->set_name( esc_html__( 'Mildhill WooCommerce Dropdown Cart', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Display a shop cart icon with a dropdown that shows products that are in the cart', 'mildhill-core' ) );

			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'cart_dropdown_icon_size',
					'title'      => esc_html__( 'Cart Dropdown Size (px)', 'mildhill-core' ),
				)
			);

			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'cart_dropdown_margin',
					'title'       => esc_html__( 'Cart Dropdown Margin', 'mildhill-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'mildhill-core' )
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'cart_dropdown_color',
					'title'      => esc_html__( 'Cart Dropdown Color', 'mildhill-core' )
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'cart_dropdown_hover_color',
					'title'      => esc_html__( 'Cart Dropdown Hover Color', 'mildhill-core' )
				)
			);

			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'cart_dropdown_label',
					'title'      => esc_html__( 'Enable Cart Dropdown Label', 'mildhill-core' ),
					'options'    => mildhill_core_get_select_type_options_pool( 'no_yes', false )
				)
			);
		}

		public function render( $atts ) {
			?>

            <div class="qodef-woo-dropdown-cart qodef-m">
				<?php mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/opener', '', $atts ); ?>
				<?php mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/fragments' ); ?>
            </div>
			<?php
		}
	}
}

if ( ! function_exists( 'mildhill_core_woo_dropdown_cart_add_to_cart_fragment' ) ) {
	function mildhill_core_woo_dropdown_cart_add_to_cart_fragment( $fragments ) {
		ob_start();
		mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/fragments' );
		$fragments['.qodef-m-fragments'] = ob_get_clean();

		return $fragments;
	}

	add_filter( 'woocommerce_add_to_cart_fragments', 'mildhill_core_woo_dropdown_cart_add_to_cart_fragment' );
}

?>