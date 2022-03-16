<?php
/**
 * WooCommerce Coming Soon Template Hooks
 *
 * Action/filter hooks used for Coming Soon functions/templates
 *
 * @author   Terry Tsang
 * @category Core
 * @package  WooCommerce Coming Soon Product/Templates
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'woocommerce_get_availability', 'wc_coming_soon_product_change_stock_status_label', 10, 2 );
add_action( 'woocommerce_single_product_summary', 'wc_coming_soon_product_get_countdown_timer', 35 );
add_action( 'woocommerce_single_product_summary', 'wc_coming_soon_product_get_link_url' , 35 );