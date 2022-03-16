<?php
/**
 * WooCommerce Coming Soon Product Hooks
 *
 * @author   Terry Tsang
 * @category Core
 * @package  WooCommerce Coming Soon Product/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Write panel for single products
add_action( 'woocommerce_product_options_inventory_product_data', 'wc_write_coming_soon_product_tab_panel' );
add_action( 'woocommerce_process_product_meta', 'wc_save_coming_soon_product_tab_panel' );

