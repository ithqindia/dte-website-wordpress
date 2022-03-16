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

add_action( 'wp_enqueue_scripts', array($this, 'wc_coming_soon_product_stylesheet') );