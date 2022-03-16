<?php
 
/**
 * Plugin Name: T5r Weight Based Shipping
 * Plugin URI: http://www.transpiresolutions.com
 * Description: Custom Shipping Method for TasteHQ
 * Version: 1.0.0
 * Author: Amol Wankhede
 * Author URI: http://www.amolwankhede.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: TasteHQ-Shipping
 */

define( 'WP_DEBUG', true );

if ( ! defined( 'WPINC' ) ) {
    die;
}

/*
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php',
         apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
   
    function taw_shipping_method() {
        if ( ! class_exists( 'Taw_Shipping_Method' ) ) {
            class Taw_Shipping_Method extends WC_Shipping_Method {
                /**
                 * Constructor for your shipping class
                 *
                 * @access public
                 * @return void
                 */
                public function __construct() {
                    $this->id                 = 'taw'; 
                    $this->method_title       = __( 'TasteHQ Shipping', 'taw' );  
                    $this->method_description = __( 'Custom Shipping Method for TasteHQ', 'taw' ); 

                    $this->init();
 
                    $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'Taw Shipping', 'taw' );
                }

                /**
                 * Define settings field for this shipping
                 * @return void 
                 */
                function init_form_fields() { 
                    $this->form_fields = array( 
                        'enabled' => array(
                              'title' => __( 'Enable', 'taw' ),
                              'type' => 'checkbox',
                              'description' => __( 'Enable this shipping.', 'taw' ),
                              'default' => 'yes'),
     
                        'title' => array(
                            'title' => __( 'Title', 'taw' ),
                              'type' => 'text',
                              'description' => __( 'Title to be display on site', 'taw' ),
                              'default' => __( 'TasteHQ Shipping', 'taw' ) ),
     
                        'weight' => array(
                            'title' => __( 'Weight (kg)', 'taw' ),
                              'type' => 'number',
                              'description' => __( 'Maximum allowed weight', 'taw' ),
                              'default' => 10 ),
                    );
                }
 
                /**
                 * Init your settings
                 *
                 * @access public
                 * @return void
                 */
                function init() {
                    // Load the settings API
                    $this->init_form_fields(); 
                    $this->init_settings(); 
 
                    // Save settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }   

                /**
                 * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
                 *
                 * @access public
                 * @param mixed $package
                 * @return void
                 */
                public function calculate_shipping( $package ) {
                    $weight = 0;
                    $cost = 0;
                    $city = $package["destination"]["state"];
 
                    foreach ( $package['contents'] as $item_id => $values ) {
                        $_product = $values['data']; 
                        $weight = $weight + $_product->get_weight() * $values['quantity']; 
                    }
 
                    $weight = wc_get_weight( $weight, 'kg' );
 
                    $costingArray = array(
                                'AK' => array('Auckland', 5.00, 5.00, 10.00, 20.00),
                                'BP' => array('Bay of Plenty', 5.00, 5.00, 10.00, 20.00),
                                'GI' => array('Gisborne', 5.00, 5.00, 10.00, 20.00),
                                'HB' => array('Hawkes Bay', 5.00, 5.00, 10.00, 20.00),
                                'MW' => array('Manawatu', 5.00, 5.00, 10.00, 20.00),
                                'NL' => array('Northland' , 5.00, 5.00, 10.00, 20.00),
                                'TK' => array('Taranaki', 5.00, 5.00, 10.00, 20.00),
                                'WA' => array('Waikato', 5.00, 5.00, 10.00, 20.00),
                                'WU' => array('Wanganui', 5.00, 5.00, 10.00, 20.00),
                                'WE' => array('Wellington', 5.00, 5.00, 10.00, 20.00),

                                'CT' => array('Canterbury', 7.00, 10.00, 20.00, 40.00),
                                'MB' => array('Marlborough', 7.00, 10.00, 20.00, 40.00),
                                'NS' => array('Nelson', 7.00, 10.00, 20.00, 40.00),
                                'OT' => array('Otago', 7.00, 10.00, 20.00, 40.00),
                                'SL' => array('Southland' , 7.00, 10.00, 20.00, 40.00),
                                'TM' => array('Tasman', 7.00, 10.00, 20.00, 40.00),
                                'WC' => array('West Coast', 7.00, 10.00, 20.00, 40.00),
                             );
                    if($weight <= 1) {  // 1 to 4 packets
                        $weightCategory = 1; 
                    } else if($weight > 1 && $weight <= 3) { // 4 to 14 packets
                        $weightCategory = 2;
                    } else if($weight > 3 && $weight < 5.916) { // 15 to 28 packets
                        $weightCategory = 3;
                    } else { // more than 28 packets
                        $weightCategory = 4;
                    }   

                    $cost = $costingArray[$city][$weightCategory];
      
                    $rate = array(
                        'id' => $this->id,
                        'label' => $this->title,
                        'cost' => $cost
                    );
 
                    $this->add_rate( $rate );
                }
            }
        }
    }

    add_action( 'woocommerce_shipping_init', 'taw_shipping_method' );
 
    function add_taw_shipping_method( $methods ) {
        $methods[] = 'Taw_Shipping_Method';
        return $methods;
    }
 
    add_filter( 'woocommerce_shipping_methods', 'add_taw_shipping_method' );
 
    function taw_validate_order( $posted )   {
        $packages = WC()->shipping->get_packages();
 
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
         
        if( is_array( $chosen_methods ) && in_array( 'taw', $chosen_methods ) ) {
             
            foreach ( $packages as $i => $package ) {
                if ( $chosen_methods[ $i ] != "taw" ) { continue; }
 
                $Taw_Shipping_Method = new Taw_Shipping_Method();
                $weightLimit = (int) $Taw_Shipping_Method->settings['weight'];
                $weight = 0;
 
                foreach ( $package['contents'] as $item_id => $values ) {
                    $_product = $values['data']; 
                    $weight = $weight + $_product->get_weight() * $values['quantity']; 
                }
 
                $weight = wc_get_weight( $weight, 'kg' );

                if( $weight > $weightLimit ) {
                    $message = sprintf( __( 'Sorry, your package weighs %d kg which exceeds the maximum allowed weight of %d kg', 'taw' ), $weight, $weightLimit);
                         
                    $messageType = "error";

                    if( ! wc_has_notice( $message, $messageType ) ) {
                        wc_add_notice( $message, $messageType );
                    }
                }
            }       
        } 
    }
    
    add_action( 'woocommerce_review_order_before_cart_contents', 'taw_validate_order' , 99 );
    add_action( 'woocommerce_after_checkout_validation', 'taw_validate_order' , 99 );
}