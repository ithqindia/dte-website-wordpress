<?php
/**
 * WooCommerce Coming Soon Admin.
 *
 * @author   Terry Tsang
 * @category Admin
 * @package  WooCommerce Coming Soon Product/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Coming_Soon_Product_Admin' ) ) {

class WC_Coming_Soon_Product_Admin {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		// Actions
		add_action( 'current_screen', array( $this, 'conditonal_includes' ) );
	} // END __construct()

	/**
	 * Include admin files conditionally.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function conditonal_includes() {
		$screen = get_current_screen();

		switch ( $screen->id ) {

			case 'product' :
				include( 'post-types/meta-boxes/class-wc-coming-soon-product-meta-box.php' );
				break;

		} // END switch
	} // END conditional_includes()

} // END class WC_Coming_Soon_Product_Admin()

} // END if class_exists('WC_Coming_Soon_Product_Admin')

return new WC_Coming_Soon_Product_Admin();
