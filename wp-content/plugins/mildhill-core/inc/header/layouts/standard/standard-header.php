<?php

class StandardHeader extends MildhillCoreHeader {
	private static $instance;

	public function __construct() {
		$this->slug                  = 'standard';
		$this->search_layout         = 'covers-header';
		$this->default_header_height = 105;

		add_filter( 'body_class', array( $this, 'add_body_classes' ) );

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function add_body_classes( $classes ) {
		$header_menu_position = mildhill_core_get_post_value_through_levels( 'qodef_standard_header_menu_position' );

		$classes[] = ! empty( $header_menu_position ) ? 'qodef-header-standard--' . $header_menu_position : '';

		return $classes;
	}
}