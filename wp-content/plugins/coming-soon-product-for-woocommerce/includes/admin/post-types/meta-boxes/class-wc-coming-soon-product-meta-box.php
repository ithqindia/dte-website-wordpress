<?php
/**
 * WooCommerce Coming Soon Post Meta Data
 *
 * Adds additional fields to the product meta data.
 *
 * @author  Terry Tsang
 * @package WooCommerce Coming Soon Product/Admin/Post Types/Meta Boxes
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Adds the option to set the product as coming soon for single products.
 *
 * @since  1.0.0
 * @access public
 * @uses   woocommerce_wp_checkbox()
 * @uses   woocommerce_wp_text_input()
 */
function wc_write_coming_soon_product_tab_panel() {
	echo '<div class="options_group">';
	woocommerce_wp_checkbox(
		array(
			'id'            => '_set_coming_soon',
			'label'         => __( 'Set for Coming Soon?', 'wc-coming-soon-product' ),
			'desc_tip'      => true,
			'description'   => __( 'You have to set the stock to "Out of Stock".', 'wc-coming-soon-product' ),
			'wrapper_class' => 'hide_if_variable',
		)
	);
	woocommerce_wp_text_input(
		array(
			'id'            => '_coming_soon_label',
			'label'         => __( 'Coming Soon Label', 'wc-coming-soon-product' ),
			'placeholder'   => __( 'Coming Soon', 'wc-coming-soon-product' ),
			'desc_tip'      => true,
			'description'   => __( 'Enter the label you want to show if coming soon is set. Default: Coming Soon', 'wc-coming-soon-product' ),
			'wrapper_class' => 'hide_if_variable',
		)
	);
	woocommerce_wp_checkbox(
		array(
			'id'            => '_coming_soon_countdown',
			'label'         => __( 'Show Countdown Clock?', 'wc-coming-soon-product' ),
			'desc_tip'      => true,
			'description'   => __( 'Enable this to show the clockdown clock for Coming Soon product', 'wc-coming-soon-product' ),
			'wrapper_class' => 'hide_if_variable',
		)
	);
	woocommerce_wp_text_input(
		array(
			'id'            => '_coming_soon_countdown_date',
			'label'         => __( 'Launch Date', 'wc-coming-soon-product' ),
			'placeholder' 	=> _x( 'YYYY-MM-DD', 'placeholder', 'woocommerce' ),
			'desc_tip'      => true,
			'description'   => __( 'Set this if countdown clock is enabled', 'wc-coming-soon-product' ),
			'class' 		=> 'date-picker', 
			'custom_attributes' => array( 'pattern' => "[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" ),
			'wrapper_class' => 'hide_if_variable',
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'            => '_coming_soon_link_text',
			'label'         => __( 'Additional Link Text', 'wc-coming-soon-product' ),
			'placeholder'   => __( 'Link Text', 'wc-coming-soon-product' ),
			'desc_tip'      => true,
			'description'   => __( 'Enter the link text you want to show below countdown clock. (Optional)', 'wc-coming-soon-product' ),
			'wrapper_class' => 'hide_if_variable',
		)
	);
	woocommerce_wp_text_input(
		array(
			'id'            => '_coming_soon_link_url',
			'label'         => __( 'Additional Link URL', 'wc-coming-soon-product' ),
			'placeholder'   => __( 'Link URL', 'wc-coming-soon-product' ),
			'desc_tip'      => true,
			'description'   => __( 'Enter the link URL to redirect the user to other page (Optional)', 'wc-coming-soon-product' ),
			'wrapper_class' => 'hide_if_variable',
		)
	);
	echo '</div>';
} // END wc_write_coming_soon_product_tab_panel()

/**
 * Saves the product options for single products.
 *
 * @since  1.0.0
 * @access public
 * @param  $post_id
 */
function wc_save_coming_soon_product_tab_panel( $post_id ) {
	$wc_coming_soon_product						= isset( $_POST['_set_coming_soon'] ) ? 'yes' : '';
	$wc_coming_soon_product_label   			= trim( strip_tags( $_POST['_coming_soon_label'] ) );
	$wc_coming_soon_product_countdown 			= isset( $_POST['_coming_soon_countdown'] ) ? 'yes' : '';
	$wc_coming_soon_product_countdown_date   	= trim( strip_tags( $_POST['_coming_soon_countdown_date'] ) );
	$wc_coming_soon_product_link_text   		= trim( strip_tags( $_POST['_coming_soon_link_text'] ) );
	$wc_coming_soon_product_link_url   			= trim( strip_tags( $_POST['_coming_soon_link_url'] ) );

	if ( !empty( $wc_coming_soon_product ) && $wc_coming_soon_product == 'yes' ) {
		update_post_meta( $post_id, '_set_coming_soon', $wc_coming_soon_product );
	} else {
		delete_post_meta( $post_id, '_set_coming_soon' );
	}

	if ( isset( $wc_coming_soon_product_label ) ) {
		update_post_meta( $post_id, '_coming_soon_label', $wc_coming_soon_product_label );
	} else {
		delete_post_meta( $post_id, '_coming_soon_label' );
	}

	if ( !empty( $wc_coming_soon_product_countdown ) && $wc_coming_soon_product_countdown == 'yes' ) {
		update_post_meta( $post_id, '_coming_soon_countdown', $wc_coming_soon_product_countdown );
	} else {
		delete_post_meta( $post_id, '_coming_soon_countdown' );
	}

	if ( isset( $wc_coming_soon_product_countdown_date ) ) {
		update_post_meta( $post_id, '_coming_soon_countdown_date', $wc_coming_soon_product_countdown_date );
	} else {
		delete_post_meta( $post_id, '_coming_soon_countdown_date' );
	}

	if ( isset( $wc_coming_soon_product_link_text ) ) {
		update_post_meta( $post_id, '_coming_soon_link_text', $wc_coming_soon_product_link_text );
	} else {
		delete_post_meta( $post_id, '_coming_soon_link_text' );
	}

	if ( isset( $wc_coming_soon_product_link_url ) ) {
		update_post_meta( $post_id, '_coming_soon_link_url', $wc_coming_soon_product_link_url );
	} else {
		delete_post_meta( $post_id, '_coming_soon_link_url' );
	}
} // END wc_save_coming_soon_product_tab_panel()
