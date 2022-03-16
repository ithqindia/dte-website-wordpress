<?php
/*
Plugin Name: Mildhill Core
Description: Plugin that adds portfolio post type, shortcodes and other modules
Author: Qode Themes
Version: 1.2
*/
if ( ! class_exists( 'MildhillCore' ) ) {
	class MildhillCore {
		private static $instance;
		
		function __construct() {
			$this->require_core();
			
			add_filter( 'qode_framework_filter_register_admin_options', array( $this, 'create_core_options' ) );
			
			add_action( 'qode_framework_action_before_options_init_' . MILDHILL_CORE_OPTIONS_NAME, array( $this, 'init_core_options' ) );
			
			add_action( 'qode_framework_action_populate_meta_box', array( $this, 'init_core_meta_boxes' ) );
			
			// Include plugin assets
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			
			// Make plugin available for translation
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
			
			// Add plugin's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );
			
			// Hook to include additional modules when plugin loaded
			do_action( 'mildhill_core_action_core_plugin_loaded' );
		}
		
		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		function require_core() {
			require_once 'constants.php';
			require_once 'helpers/include.php';
			
			// Hook to include additional files before modules inclusion
			do_action( 'mildhill_core_action_before_include_modules' );

			foreach ( glob( MILDHILL_CORE_INC_PATH . '/*/include.php' ) as $module ) {
				include_once $module;
			}
			
			// Hook to include additional files after modules inclusion
			do_action( 'mildhill_core_action_after_include_modules' );
		}
		
		function create_core_options( $options ) {
			$mildhill_core_options_admin = new QodeFrameworkOptionsAdmin(
				MILDHILL_CORE_MENU_NAME,
				MILDHILL_CORE_OPTIONS_NAME,
				array(
					'label' => esc_html__( 'Mildhill Core Options', 'mildhill-core' )
				)
			);
			$options[] = $mildhill_core_options_admin;
			
			return $options;
		}
		
		function init_core_options() {
			$qode_framework = qode_framework_get_framework_root();
			
			if ( ! empty( $qode_framework ) ) {
				$page = $qode_framework->add_options_page(
					array(
						'scope'       => MILDHILL_CORE_OPTIONS_NAME,
						'type'        => 'admin',
						'slug'        => 'general',
						'title'       => esc_html__( 'General', 'mildhill-core' ),
						'description' => esc_html__( 'General Core Options', 'mildhill-core' ),
						'icon'        => 'fa fa-cog'
					)
				);
				
				// Hook to include additional options after default options
				do_action( 'mildhill_core_action_default_options_init', $page );
			}
		}
		
		function init_core_meta_boxes() {
			do_action( 'mildhill_core_action_default_meta_boxes_init' );
		}
		
		function enqueue_assets() {
			// CSS and JS dependency variables
			$style_dependency_array  = apply_filters( 'mildhill_core_filter_style_dependencies', array( 'mildhill-main' ) );
			$script_dependency_array = apply_filters( 'mildhill_core_filter_script_dependencies', array( 'mildhill-main-js' ) );
			
			// Hook to include additional scripts before plugin's main style
			do_action( 'mildhill_core_action_before_main_css' );
			
			// Enqueue plugin's main style
			wp_enqueue_style( 'mildhill-core-style', MILDHILL_CORE_URL_PATH . 'assets/css/mildhill-core.min.css', $style_dependency_array );
			
			// Enqueue plugin's 3rd party scripts
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'modernizr', MILDHILL_CORE_URL_PATH . 'assets/plugins/modernizr/modernizr.js', array( 'jquery' ), false, true );
			
			// Hook to include additional scripts before plugin's main script
			do_action( 'mildhill_core_action_before_main_js' );
			
			// Enqueue plugin's main script
			wp_enqueue_script( 'mildhill-core-script', MILDHILL_CORE_URL_PATH . 'assets/js/mildhill-core.js', $script_dependency_array, false, true );
		}
		
		function load_plugin_textdomain() {
			load_plugin_textdomain( 'mildhill-core', false, MILDHILL_CORE_REL_PATH . '/languages' );
		}
		
		function add_body_classes( $classes ) {
			$classes[] = 'mildhill-core-' . MILDHILL_CORE_VERSION;
			
			return $classes;
		}
	}
}

if ( ! function_exists( 'mildhill_core_instantiate_core_plugin' ) ) {
	function mildhill_core_instantiate_core_plugin() {
		MildhillCore::get_instance();
	}
	
	add_action( 'qode_framework_action_load_dependent_plugins', 'mildhill_core_instantiate_core_plugin' );
}

if ( ! function_exists( 'mildhill_core_activation_trigger' ) ) {
	function mildhill_core_activation_trigger() {
		// Hook to add additional code on plugin activation
		do_action( 'mildhill_core_action_on_activation' );
	}

	register_activation_hook( __FILE__, 'mildhill_core_activation_trigger' );
}
if ( ! function_exists( 'mildhill_core_deactivation_trigger' ) ) {
	function mildhill_core_deactivation_trigger() {
		// Hook to add additional code on plugin deactivation
		do_action( 'mildhill_core_action_on_deactivation' );
	}

	register_deactivation_hook( __FILE__, 'mildhill_core_deactivation_trigger' );
}

if( ! function_exists( 'mildhill_core_check_requirements' ) ) {
	function mildhill_core_check_requirements() {
		if ( ! defined( 'QODE_FRAMEWORK_VERSION' ) ) {
			add_action( 'admin_notices', 'mildhill_core_admin_notice_content' );
		}
	}
	
	add_action( 'plugins_loaded', 'mildhill_core_check_requirements' );
}

if( ! function_exists( 'mildhill_core_admin_notice_content' ) ) {
	function mildhill_core_admin_notice_content() {
		echo sprintf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'Qode Framework plugin is required for Mildhill Core plugin to work properly. Please install/activate it first.', 'mildhill-core' ) );
		
		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	}
}
