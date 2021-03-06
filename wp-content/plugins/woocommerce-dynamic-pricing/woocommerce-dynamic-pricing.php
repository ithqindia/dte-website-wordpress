<?php

/*
  Plugin Name: WooCommerce Dynamic Pricing
  Plugin URI: http://www.woothemes.com/woocommerce
  Description: WooCommerce Dynamic Pricing lets you configure dynamic pricing rules for products, categories and members. For WooCommerce 1.4+
  Version: 2.10.11
  Author: Lucas Stark
  Author URI: http://lucasstark.com
  Requires at least: 3.3
  Tested up to: 3.5.1

  Copyright: © 2009-2015 Lucas Stark.
  License: GNU General Public License v3.0
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


/**
 * Required functions
 */
if ( !function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '9a41775bb33843f52c93c922b0053986', '18643' );

if ( is_woocommerce_active() ) {


	/**
	 * Localisation
	 * */
	load_plugin_textdomain( 'wc_pricing', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );



	/**
	 * Boot up dynamic pricing
	 */
	WC_Dynamic_Pricing::init();
}

class WC_Dynamic_Pricing {

	private static $instance;

	public static function init() {
		if ( self::$instance == null ) {
			self::$instance = new WC_Dynamic_Pricing();
		}
	}

	public static function instance() {
		if ( self::$instance == null ) {
			self::init();
		}

		return self::$instance;
	}

	public $modules = array();

	public function __construct() {
		add_action( 'woocommerce_cart_loaded_from_session', array(&$this, 'on_cart_loaded_from_session'), 99, 1 );

		//Add the actions dynamic pricing uses to trigger price adjustments
		add_action( 'woocommerce_before_calculate_totals', array(&$this, 'on_calculate_totals'), 99, 1 );


		if ( is_admin() ) {
			require 'admin/admin-init.php';
		}

		//Include additional integrations
		if ( wc_dynamic_pricing_is_groups_active() ) {
			include 'integrations/groups/groups.php';
		}

		//Paypal express
		include 'integrations/paypal-express.php';
		include 'classes/class-wc-dynamic-pricing-compatibility.php';

		if ( !is_admin() || defined( 'DOING_AJAX' ) ) {
			//Include helper classes
			include 'classes/class-wc-dynamic-pricing-counter.php';
			include 'classes/class-wc-dynamic-pricing-tracker.php';
			include 'classes/class-wc-dynamic-pricing-cart-query.php';


			include 'classes/class-wc-dynamic-pricing-adjustment-set.php';
			include 'classes/class-wc-dynamic-pricing-adjustment-set-category.php';
			include 'classes/class-wc-dynamic-pricing-adjustment-set-product.php';
			include 'classes/class-wc-dynamic-pricing-adjustment-set-totals.php';


			//The base pricing module.
			include 'classes/modules/class-wc-dynamic-pricing-module-base.php';

			//Include the advanced pricing modules.
			include 'classes/modules/class-wc-dynamic-pricing-advanced-base.php';
			include 'classes/modules/class-wc-dynamic-pricing-advanced-product.php';
			include 'classes/modules/class-wc-dynamic-pricing-advanced-category.php';
			include 'classes/modules/class-wc-dynamic-pricing-advanced-totals.php';

			//Include the simple pricing modules.
			include 'classes/modules/class-wc-dynamic-pricing-simple-base.php';
			include 'classes/modules/class-wc-dynamic-pricing-simple-product.php';
			include 'classes/modules/class-wc-dynamic-pricing-simple-category.php';
			include 'classes/modules/class-wc-dynamic-pricing-simple-membership.php';




			//Include the UX module - This controls the display of discounts on cart items and products.
			include 'classes/class-wc-dynamic-pricing-frontend-ux.php';


			//Boot up the instances of the pricing modules
			$modules['advanced_product'] = WC_Dynamic_Pricing_Advanced_Product::instance();
			$modules['advanced_category'] = WC_Dynamic_Pricing_Advanced_Category::instance();

			$modules['simple_product'] = WC_Dynamic_Pricing_Simple_Product::instance();
			$modules['simple_category'] = WC_Dynamic_Pricing_Simple_Category::instance();
			$modules['simple_membership'] = WC_Dynamic_Pricing_Simple_Membership::instance();

			if ( wc_dynamic_pricing_is_groups_active() ) {
				include 'integrations/groups/class-wc-dynamic-pricing-simple-group.php';
				$modules['simple_group'] = WC_Dynamic_Pricing_Simple_Group::instance();
			}

			$modules['advanced_totals'] = WC_Dynamic_Pricing_Advanced_Totals::instance();

			$this->modules = apply_filters( 'wc_dynamic_pricing_load_modules', $modules );



			/* Boot up required classes */
			//Initialize the dynamic pricing counter.  Records various counts when items are restored from session.
			WC_Dynamic_Pricing_Counter::register();

			//Initialize the FrontEnd UX modifications
			WC_Dynamic_Pricing_FrontEnd_UX::init();


			//Filters for simple adjustment types
			//add_filter( 'woocommerce_grouped_price_html', array(&$this, 'on_price_html'), 10, 2 );
			//add_filter( 'woocommerce_sale_price_html', array(&$this, 'on_price_html'), 10, 2 );
			//add_filter( 'woocommerce_price_html', array(&$this, 'on_price_html'), 10, 2 );
			//add_filter( 'woocommerce_empty_price_html', array(&$this, 'on_price_html'), 10, 2 );
			//Dont think the following filter is required, because regular get price filter is also called. 
			//add_filter( 'woocommerce_variable_price_html', array($this, 'on_price_html'), 10, 2 );
			//add_filter( 'woocommerce_variable_sale_price_html', array($this, 'on_price_html'), 10, 2 );
			//Filters the variation price displayed when a variation is selected. 

			add_filter( 'woocommerce_variation_price_html', array(&$this, 'on_price_html'), 10, 2 );

			//add_filter( 'woocommerce_variation_sale_price_html', array(&$this, 'on_price_html'), 10, 2 );

			add_action( 'woocommerce_before_mini_cart', array($this, 'remove_price_filters') );
			add_action( 'woocommerce_after_mini_cart', array($this, 'add_price_filters') );
			add_filter( 'woocommerce_product_is_on_sale', array($this, 'on_get_product_is_on_sale'), 10, 2 );



			add_filter( 'woocommerce_get_variation_price', array($this, 'on_get_variation_price'), 10, 4 );
			add_filter( 'woocommerce_get_price_html', array(&$this, 'on_price_html'), 10, 2 );
			add_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );

			add_filter( 'woocommerce_composite_get_price', array($this, 'on_get_price'), 10, 2 );
			add_filter( 'woocommerce_composite_get_base_price', array($this, 'on_get_price'), 10, 2 );
		}

		add_filter( 'woocommerce_dynamic_pricing_get_rule_amount', array($this, 'convert_decimals'), 99, 4 );
	}

	/**
	 * Remove the price filter when mini-cart is triggered. 
	 * @since 2.10.2
	 */
	public function remove_price_filters() {
		remove_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );
	}

	/**
	 * Add the price filters back in after mini-cart is done. 
	 * @since 2.10.2
	 */
	public function add_price_filters() {
		add_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );
	}

	public function convert_decimals( $amount, $rule, $cart_item, $module ) {
		if ( function_exists( 'wc_format_decimal' ) ) {
			$amount = wc_format_decimal( str_replace( get_option( 'woocommerce_price_thousand_sep' ), '', $amount ) );
		}
		return $amount;
	}

	public function on_cart_loaded_from_session( $cart ) {
		global $woocommerce;

		$sorted_cart = array();
		if ( sizeof( $cart->cart_contents ) > 0 ) {
			foreach ( $cart->cart_contents as $cart_item_key => $values ) {

				if ( isset( $cart->cart_contents[$cart_item_key]['discounts'] ) ) {
					unset( $cart->cart_contents[$cart_item_key]['discounts'] );
				}

				$sorted_cart[$cart_item_key] = $values;
			}
		}

		//Sort the cart so that the lowest priced item is discounted when using block rules.
		@uasort( $sorted_cart, 'WC_Dynamic_Pricing_Cart_Query::sort_by_price' );

		$modules = apply_filters( 'wc_dynamic_pricing_load_modules', $this->modules );
		foreach ( $modules as $module ) {
			$module->adjust_cart( $sorted_cart );
		}
	}

	public function on_calculate_totals( $cart ) {
		global $woocommerce;

		$sorted_cart = array();
		if ( sizeof( $cart->cart_contents ) > 0 ) {
			foreach ( $cart->cart_contents as $cart_item_key => $values ) {
				$sorted_cart[$cart_item_key] = $values;
			}
		}

		//Sort the cart so that the lowest priced item is discounted when using block rules.
		uasort( $sorted_cart, 'WC_Dynamic_Pricing_Cart_Query::sort_by_price' );

		$modules = apply_filters( 'wc_dynamic_pricing_load_modules', $this->modules );
		foreach ( $modules as $module ) {
			$module->adjust_cart( $sorted_cart );
		}
	}

	/**
	 * @since 2.6.1
	 * @param type $base_price
	 * @param type $_product
	 * @return float
	 */
	public function on_get_price( $base_price, $_product, $force_calculation = false ) {
		$composite_ajax = did_action( 'wp_ajax_woocommerce_show_composited_product' ) | did_action( 'wp_ajax_nopriv_woocommerce_show_composited_product' ) | did_action( 'wc_ajax_woocommerce_show_composited_product' );

		if ( is_product() || $force_calculation || $composite_ajax ) {
			$id = isset( $_product->variation_id ) ? $_product->variation_id : $_product->id;
			$discount_price = false;
			$working_price = isset( $this->discounted_products[$id] ) ? $this->discounted_products[$id] : $base_price;

			$modules = apply_filters( 'wc_dynamic_pricing_load_modules', $this->modules );
			foreach ( $modules as $module ) {
				if ( $module->module_type == 'simple' ) {
					//Make sure we are using the price that was just discounted.
					$working_price = $discount_price ? $discount_price : $base_price;
					$working_price = $module->get_product_working_price( $working_price, $_product );
					if ( $working_price !== false ) {
						$discount_price = $module->get_discounted_price_for_shop( $_product, $working_price );
					}
				}
			}
			
			if ( $discount_price !== false ) {
				return $discount_price;
			} else {
				return $base_price;
			}
		} else {
			return $base_price;
		}
	}

	/**
	 * @since 2.9.8
	 * @param type $base_price
	 * @param type $_product
	 * @return float
	 */
	private function get_discounted_price( $base_price, $_product ) {

		$id = isset( $_product->variation_id ) ? $_product->variation_id : $_product->id;
		$discount_price = false;
		$working_price = isset( $this->discounted_products[$id] ) ? $this->discounted_products[$id] : $base_price;

		$modules = apply_filters( 'wc_dynamic_pricing_load_modules', $this->modules );
		foreach ( $modules as $module ) {
			if ( $module->module_type == 'simple' ) {
				//Make sure we are using the price that was just discounted.
				$working_price = $discount_price ? $discount_price : $base_price;
				$working_price = $module->get_product_working_price( $working_price, $_product );
				if ( floatval( $working_price ) ) {
					$discount_price = $module->get_discounted_price_for_shop( $_product, $working_price );
				}
			}
		}

		if ( $discount_price ) {
			return $discount_price;
		} else {
			return $base_price;
		}
	}

	public function on_get_variation_price( $price, $product, $min_or_max, $display ) {
		$min_price = $price;
		$max_price = $price;
		$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );

		$children = $product->get_children();
		if ( isset( $children ) && !empty( $children ) ) {
			foreach ( $children as $variation_id ) {
				if ( $display ) {
					$variation = $product->get_child( $variation_id );
					if ( $variation ) {
						remove_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );
						$base_price = $tax_display_mode == 'incl' ? $variation->get_price_including_tax() : $variation->get_price_excluding_tax();
						$calc_price = $base_price;
						$discount_price = $this->get_discounted_price( $base_price, $variation );
						if ( $discount_price && $base_price != $discount_price ) {
							$calc_price = $discount_price;
						}
						add_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );
					} else {
						$calc_price = '';
					}
				} else {
					$calc_price = get_post_meta( $variation_id, '_price', true );
				}


				if ( $min_price == null || $calc_price < $min_price ) {
					$min_price = $calc_price;
				}

				if ( $max_price == null || $calc_price > $max_price ) {
					$max_price = $calc_price;
				}
			}
		}

		if ( $min_or_max == 'min' ) {
			return $min_price;
		} elseif ( $min_or_max == 'max' ) {
			return $max_price;
		} else {
			return $price;
		}
	}

	public function on_price_html( $html, $_product ) {
		if ( $_product ) {
			remove_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );

			$from = strstr( $html, __( 'From', 'woocommerce' ) ) !== false ? ' ' . __( 'From', 'woocommerce' ) . ' ' : ' ';
			$discount_price = false;
			$id = isset( $_product->variation_id ) ? $_product->variation_id : $_product->id;

			if ( apply_filters( 'wc_dynamic_pricing_get_use_sale_price', true, $_product ) ) {
				$working_price = $_product->get_price();
			} else {
				$working_price = $_product->get_regular_price();
			}

			$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
			$base_price = $tax_display_mode == 'incl' ? $_product->get_price_including_tax( 1, $working_price ) : $_product->get_price_excluding_tax( 1, $working_price );
			$working_discount_price = $base_price;

			$discounted = false;
			$modules = apply_filters( 'wc_dynamic_pricing_load_modules', $this->modules );
			foreach ( $modules as $module ) {
				if ( $module->module_type == 'simple' ) {

					//Make sure we are using the price that was just discounted.
					$working_price = $working_discount_price ? $working_discount_price : $base_price;
					$working_price = $module->get_product_working_price( $working_price, $_product );

					if ( floatval( $working_price ) ) {
						$wd = $module->get_discounted_price_for_shop( $_product, $working_price );

						if ( $wd && $wd != $base_price ) {

							$cumulative = apply_filters( 'woocommerce_dynamic_pricing_is_cumulative', true, $module->module_id, array('data' => $_product), '' );
							if ( $discounted && !$cumulative ) {
								continue;
							}

							$working_discount_price = $wd;
							$discounted = true;

							$display_price = $working_discount_price;

							//Set the discount price for use later. 
							$discount_price = $working_discount_price;

							if ( apply_filters( 'wc_dynamic_pricing_use_discount_format', true ) ) {

								if ( $_product->is_type( 'variable' ) ) {
									$from = '<span class="from">' . _x( 'From:', 'min_price', 'woocommerce' ) . ' </span>';
								}

								$html = '<del>' . WC_Dynamic_Pricing_Compatibility::wc_price( $base_price ) . '</del><ins> ' . $from . WC_Dynamic_Pricing_Compatibility::wc_price( $display_price ) . '</ins>';
							} else {

								if ( $_product->is_type( 'variable' ) ) {
									$from = '<span class="from">' . _x( 'From:', 'min_price', 'woocommerce' ) . ' </span>';
								}

								$html = $from . WC_Dynamic_Pricing_Compatibility::wc_price( $display_price );
							}

							$html .= $_product->get_price_suffix();
						} elseif ( $wd === 0 || $wd === 0.00 ) {
							$html = $_product->get_price_html_from_to( $_product->regular_price, __( 'Free!', 'woocommerce' ) );
							//Set the discount price for use later. 
							$working_discount_price = $wd;
							$discount_price = $working_discount_price;
						}
					}
				}
			}

			$this->discounted_products[$id] = $discount_price ? $discount_price : $base_price;

			add_filter( 'woocommerce_get_price', array($this, 'on_get_price'), 10, 2 );

			return apply_filters( 'wc_dynamic_pricing_price_html', $html, $_product );
		} else {
			return $html;
		}
	}

	/**
	 * Overrides the default woocommerce is on sale to ensure sale badges show properly. 
	 * @since 2.10.8
	 * @param bool $is_on_sale
	 * @param WC_Product $product
	 * @return bool
	 */
	public function on_get_product_is_on_sale( $is_on_sale, $product ) {
		if ( $is_on_sale ) {
			return $is_on_sale;
		}

		if ( $product->is_type( 'variable' ) ) {
			$is_on_sale = false;
			$prices = $product->get_variation_prices();
			if ( $prices['price'] !== $prices['regular_price'] ) {
				$is_on_sale = true;
			}
		} else {

			$dynamic_price = $this->on_get_price( $product->price, $product, true );
			$regular_price = $product->get_regular_price();

			if ( empty( $regular_price ) || empty( $dynamic_price ) ) {
				return $is_on_sale;
			} else {
				$is_on_sale = $regular_price != $dynamic_price;
			}
		}

		return $is_on_sale;
	}

	//Helper functions to modify the woocommerce cart.  Called from the individual modules.
	public static function apply_cart_item_adjustment( $cart_item_key, $original_price, $adjusted_price, $module, $set_id ) {
		global $woocommerce;

		$adjusted_price = apply_filters( 'wc_dynamic_pricing_apply_cart_item_adjustment', $adjusted_price, $cart_item_key, $original_price, $module );

		if ( isset( $woocommerce->cart->cart_contents[$cart_item_key] ) ) {
			$_product = $woocommerce->cart->cart_contents[$cart_item_key]['data'];

			if ( apply_filters( 'wc_dynamic_pricing_get_use_sale_price', true, $_product ) ) {
				$display_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
			} else {
				$display_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax( 1, $original_price ) : $_product->get_price_including_tax( 1, $original_price );
			}

			$woocommerce->cart->cart_contents[$cart_item_key]['data']->price = $adjusted_price;

			if ( $_product->product_type == 'composite' ) {
				$woocommerce->cart->cart_contents[$cart_item_key]['data']->base_price = $adjusted_price;
			}


			if ( !isset( $woocommerce->cart->cart_contents[$cart_item_key]['discounts'] ) ) {

				$discount_data = array(
				    'by' => array($module),
				    'set_id' => $set_id,
				    'price_base' => $original_price,
				    'display_price' => $display_price,
				    'price_adjusted' => $adjusted_price,
				    'applied_discounts' => array(array('by' => $module, 'set_id' => $set_id, 'price_base' => $original_price, 'price_adjusted' => $adjusted_price))
				);
				$woocommerce->cart->cart_contents[$cart_item_key]['discounts'] = $discount_data;
			} else {

				$existing = $woocommerce->cart->cart_contents[$cart_item_key]['discounts'];

				$discount_data = array(
				    'by' => $existing['by'],
				    'set_id' => $set_id,
				    'price_base' => $original_price,
				    'display_price' => $existing['display_price'],
				    'price_adjusted' => $adjusted_price
				);

				$woocommerce->cart->cart_contents[$cart_item_key]['discounts'] = $discount_data;

				$history = array('by' => $existing['by'], 'set_id' => $existing['set_id'], 'price_base' => $existing['price_base'], 'price_adjusted' => $existing['price_adjusted']);
				array_push( $woocommerce->cart->cart_contents[$cart_item_key]['discounts']['by'], $module );
				$woocommerce->cart->cart_contents[$cart_item_key]['discounts']['applied_discounts'][] = $history;
			}
		}

		do_action( 'woocommerce_dynamic_pricing_apply_cartitem_adjustment', $cart_item_key, $original_price, $adjusted_price, $module, $set_id );
	}

	/** Helper functions ***************************************************** */

	/**
	 * Get the plugin url.
	 *
	 * @access public
	 * @return string
	 */
	public static function plugin_url() {
		return plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @access public
	 * @return string
	 */
	public static function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

}

/* Helper Functions */

function wc_dynamic_pricing_is_groups_active() {
	$result = false;
	$result = in_array( 'groups/groups.php', (array) get_option( 'active_plugins', array() ) );
	if ( !$result && is_multisite() ) {
		$plugins = get_site_option( 'active_sitewide_plugins' );
		$result = isset( $plugins['groups/groups.php'] );
	}

	return $result;
}
