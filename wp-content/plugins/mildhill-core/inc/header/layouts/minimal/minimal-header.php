<?php

class MinimalHeader extends MildhillCoreHeader {
	private static $instance;

	public function __construct() {
		$this->slug                  = 'minimal';
		$this->default_header_height = 100;

		add_action( 'mildhill_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ), 11 );

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => mildhill_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ) === 'yes'
		);

		mildhill_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}