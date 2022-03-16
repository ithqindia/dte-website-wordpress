<?php

class CoversHeaderSearch extends MildhillCoreSearch {
	private static $instance;

	public function __construct() {
		parent::__construct();

		add_action( 'wp', array( $this, 'load_template' ), 111 );
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function return_template() {
		return mildhill_core_template_part( 'search/layouts/' . $this->search_layout, 'templates/' . $this->search_layout );
	}

	public function load_template() {
		if ( is_active_widget( false, false, 'mildhill_core_search_opener' ) ) {

			$actions         = array();
			$sidebars        = qode_framework_get_widget_sidebars( 'mildhill_core_search_opener' );
			$custom_sidebars = mildhill_core_get_custom_sidebars();
			$page_id         = qode_framework_get_page_id();

			foreach ( $sidebars as $sidebar ) {
				if ( $sidebar == 'qodef-header-widget-area-one' || $sidebar == 'qodef-header-widget-area-two' ) {
					$actions[] = 'mildhill_action_before_page_header_inner_close';
					$actions[] = 'mildhill_core_action_after_sticky_header';
				} else if ( $sidebar == 'qodef-mobile-header-widget-area' ) {
					$actions[] = 'mildhill_action_after_page_mobile_header_inner';
				} else if ( $sidebar == 'qodef-top-area-left' || $sidebar == 'qodef-top-area-right' ) {
					$actions[] = 'mildhill_core_action_after_top_area';
				} else if ( array_key_exists( $sidebar, $custom_sidebars ) ) {
					$custom_menu_widget_area_one = get_post_meta( $page_id, 'qodef_header_custom_widget_area_one', true );
					$custom_menu_widget_area_two = get_post_meta( $page_id, 'qodef_header_custom_widget_area_two', true );

					if ( $sidebar == $custom_menu_widget_area_one || $sidebar == $custom_menu_widget_area_two ) {
						$actions[] = 'mildhill_action_before_page_header_inner_close';
						$actions[] = 'mildhill_core_action_after_sticky_header';
					}
				}
			}

			foreach ( $actions as $action ) {
				add_action( $action, array( $this, 'return_template' ) );
			}
		}
	}
}