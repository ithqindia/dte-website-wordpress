<?php

class CenteredHeader extends MildhillCoreHeader {
	private static $instance;

	public function __construct() {
		$this->slug                  = 'centered';
		$this->default_header_height = 277;

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}