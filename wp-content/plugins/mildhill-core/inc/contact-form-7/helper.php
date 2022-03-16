<?php

if ( ! function_exists( 'mildhill_core_get_contact_form_7_forms' ) ) {
	/**
	 * Function that return array of contact form 7 forms
	 *
	 * @param $enable_default boolean - add first element empty for default value
	 *
	 * @return array
	 */
	function mildhill_core_get_contact_form_7_forms( $enable_default = true ) {
		$options       = array();
		$contact_forms = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		if ( ! empty( $contact_forms ) ) {
			if ( $enable_default ) {
				$options[''] = esc_html__( 'Default', 'mildhill-core' );
			}
			
			foreach ( $contact_forms as $contact_form ) {
				$options[ $contact_form->ID ] = esc_html( $contact_form->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No contact forms found', 'mildhill-core' );
		}
		
		return $options;
	}
}

if ( ! function_exists( 'mildhill_core_include_contact_form_shortcodes' ) ) {
    /**
     * Function that includes shortcodes
     */
    function mildhill_core_include_contact_form_shortcodes() {
        foreach ( glob( MILDHILL_CORE_INC_PATH . '/contact-form-7/shortcodes/*/include.php' ) as $shortcode ) {
            include_once $shortcode;
        }
    }

    add_action( 'qode_framework_action_before_shortcodes_register', 'mildhill_core_include_contact_form_shortcodes' );
}
