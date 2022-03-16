<?php

if ( ! class_exists( 'MildhillCoreCustomPostTypes' ) ) {
	class MildhillCoreCustomPostTypes {
		private static $instance;
		private $allowed_post_types = array();

		public function __construct() {
			// Include core files
			$this->init();

			// Set properties value
			$this->set_enabled_post_types();

			// Include register post types file
			add_action( 'qode_framework_action_before_post_types_register', array( $this, 'include_register_files' ) );

			// Register post types
			add_action( 'qode_framework_action_before_post_types_register', array( $this, 'register_post_types' ), 11 ); // Priority 11 set because include of files is called on default action 10

			// Include taxonomies
			add_action( 'qode_framework_action_custom_taxonomy_fields', array( $this, 'include_taxonomies' ) );

			// Register taxonomies
			add_action( 'qode_framework_action_custom_taxonomy_fields', array( $this, 'register_taxonomies' ), 11 );

			// Include shortcodes
			add_action( 'qode_framework_action_before_shortcodes_register', array( $this, 'include_shortcodes' ) );

			// Include files
			$this->include_files();
		}

		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function get_allowed_post_types() {
			return $this->allowed_post_types;
		}

		public function set_allowed_post_types( $allowed_post_types ) {
			$this->allowed_post_types[] = $allowed_post_types;
		}

		function init() {
			// Include customizer options
			include_once MILDHILL_CORE_CPT_PATH . '/dashboard/customizer/post-types-customizer-options.php';
		}

		function set_enabled_post_types() {

			foreach ( glob( MILDHILL_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {

				if ( basename( $post_type ) !== 'dashboard' ) {
					$is_disabled = mildhill_core_performance_get_option_value( $post_type, 'mildhill_core_performance_post_type_' );

					if ( empty( $is_disabled ) ) {
						$this->set_allowed_post_types( $post_type );
					}
				}
			}
		}

		function include_register_files() {
			$post_types = $this->get_allowed_post_types();

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					include_once $post_type . '/register.php';
				}
			}
		}

		function register_post_types() {
			$qode_framework = qode_framework_get_framework_root();
			$cpts           = apply_filters( 'mildhill_core_filter_register_custom_post_types', $cpts = array() );

			if ( ! empty( $cpts ) ) {
				foreach ( $cpts as $cpt ) {
					$qode_framework->add_custom_post_type( new $cpt() );
				}
			}
		}

		function include_taxonomies() {
			// Hook to includes custom post types taxonomy fields
			do_action( 'mildhill_core_action_include_cpt_tax_fields' );
		}

		function register_taxonomies() {
			// Hook to includes custom post types taxonomy fields
			do_action( 'mildhill_core_action_register_cpt_tax_fields' );
		}

		function include_shortcodes() {
			$post_types = $this->get_allowed_post_types();

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					foreach ( glob( $post_type . '/shortcodes/*/include.php' ) as $shortcode ) {
						include_once $shortcode;
					}
				}
			}
		}

		function include_files() {
			$post_types = $this->get_allowed_post_types();

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					include_once $post_type . '/include.php';
				}
			}
		}
	}

	MildhillCoreCustomPostTypes::get_instance();
}