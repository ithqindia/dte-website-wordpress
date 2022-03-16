<?php

if ( ! function_exists( 'mildhill_core_add_phone_number_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function mildhill_core_add_phone_number_widget( $widgets ) {
		$widgets[] = 'MildhillCorePhoneNumberWidget';

		return $widgets;
	}

	add_filter( 'mildhill_core_filter_register_widgets', 'mildhill_core_add_phone_number_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class MildhillCorePhoneNumberWidget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'mildhill_core_phone_number' );
			$this->set_name( esc_html__( 'Mildhill Phone Number', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Use this widget to add a phone number to a widget area.', 'mildhill-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'mildhill-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'phone_number',
					'title'      => esc_html__( 'Phone number', 'mildhill-core' ),
				)
			);
		}

		public function render( $atts ) {
			if ( $atts['phone_number'][0] === '+' ) {
				$plus = '+';
			} else {
				$plus = '';
			}

			?>
            <ul>
                <li>
                    <a itemprop="telephone" href="tel:<?php echo esc_html( $plus ) . preg_replace( '/[^0-9]/', '', $atts['phone_number'] ); ?>"><?php echo esc_html( $atts['phone_number'] ); ?></a>
                </li>
            </ul>

		<?php }
	}
}
