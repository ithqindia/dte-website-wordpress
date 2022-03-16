<?php

if ( ! function_exists( 'mildhill_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function mildhill_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => MILDHILL_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'mildhill-core' ),
				'description' => esc_html__( 'General Fonts Options', 'mildhill-core' ),
				'icon'        => 'fa fa-cog'
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'mildhill-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts'
					)
				)
			);
			
			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'mildhill-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts To Include', 'mildhill-core' ),
					'description' => esc_html__( 'Choose google fonts which you want to use on your website', 'mildhill-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'mildhill-core' )
				)
			);
			
			$page_repeater->add_field_element( array(
				'field_type'  => 'googlefont',
				'name'        => 'qodef_choose_google_font',
				'title'       => esc_html__( 'Google Font', 'mildhill-core' ),
				'description' => esc_html__( 'Choose google font', 'mildhill-core' ),
				'args'        => array(
					'include' => 'google-fonts'
				)
			) );
			
			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Style & Weight', 'mildhill-core' ),
					'description' => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'mildhill-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'mildhill-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'mildhill-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'mildhill-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'mildhill-core' ),
						'300'  => esc_html__( '300 Light', 'mildhill-core' ),
						'300i' => esc_html__( '300 Light Italic', 'mildhill-core' ),
						'400'  => esc_html__( '400 Regular', 'mildhill-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'mildhill-core' ),
						'500'  => esc_html__( '500 Medium', 'mildhill-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'mildhill-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'mildhill-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'mildhill-core' ),
						'700'  => esc_html__( '700 Bold', 'mildhill-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'mildhill-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'mildhill-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'mildhill-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'mildhill-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'mildhill-core' )
					)
				)
			);
			
			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style & Weight', 'mildhill-core' ),
					'description' => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'mildhill-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'mildhill-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'mildhill-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'mildhill-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'mildhill-core' ),
						'greek'        => esc_html__( 'Greek', 'mildhill-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'mildhill-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'mildhill-core' )
					)
				)
			);
			
			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'mildhill-core' ),
					'description' => esc_html__( 'Add Custom Fonts', 'mildhill-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'mildhill-core' )
				)
			);
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_ttf',
				'title'      => esc_html__( 'Custom Font TTF', 'mildhill-core' ),
				'args'       => array(
					'allowed_type' => 'font/ttf'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_otf',
				'title'      => esc_html__( 'Custom Font OTF', 'mildhill-core' ),
				'args'       => array(
					'allowed_type' => 'font/otf'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff',
				'title'      => esc_html__( 'Custom Font WOFF', 'mildhill-core' ),
				'args'       => array(
					'allowed_type' => 'font/woff'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff2',
				'title'      => esc_html__( 'Custom Font WOFF2', 'mildhill-core' ),
				'args'       => array(
					'allowed_type' => 'font/woff2'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_custom_font_name',
				'title'      => esc_html__( 'Custom Font Name', 'mildhill-core' ),
			) );
			
			// Hook to include additional options after module options
			do_action( 'mildhill_core_action_after_page_fonts_options_map', $page );
		}
	}
	
	add_action( 'mildhill_core_action_default_options_init', 'mildhill_core_add_fonts_options', mildhill_core_get_admin_options_map_position( 'fonts' ) );
}