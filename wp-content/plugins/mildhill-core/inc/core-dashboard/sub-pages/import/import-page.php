<?php
if ( ! function_exists( 'mildhill_core_add_import_sub_page_to_list' ) ) {
	function mildhill_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'MildhillCoreImportPage';
		return $sub_pages;
	}
	
	add_filter( 'mildhill_core_filter_add_welcome_sub_page', 'mildhill_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'MildhillCoreSubPage' ) ) {
	class MildhillCoreImportPage extends MildhillCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__('Import', 'mildhill-core'));
			$this->set_atts( $this->set_atributtes());
		}

		public function set_atributtes(){
			$params = array();

			$iparams = MildhillCoreDashboard::get_instance()->get_import_params();
			if(is_array($iparams) && isset($iparams['submit'])) {
				$params['submit'] = $iparams['submit'];
			}

			return $params;
		}
	}
}