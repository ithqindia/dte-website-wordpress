<?php

if ( ! function_exists( 'mildhill_core_register_product_for_meta_options' ) ) {
	/**
	 * Function that register product post type for meta box options
	 *
	 * @param $post_types array
	 *
	 * @return array
	 */
	function mildhill_core_register_product_for_meta_options( $post_types ) {
		$post_types[] = 'product';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'mildhill_core_register_product_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'mildhill_core_register_product_for_meta_options' );
}

if ( ! function_exists( 'mildhill_core_is_woo_page' ) ) {
	/**
	 * Function that check WooCommerce pages
	 *
	 * @param $page string
	 *
	 * @return bool
	 */
	function mildhill_core_is_woo_page( $page ) {
		switch ( $page ) {
			case 'shop':
				return function_exists( 'is_shop' ) && is_shop();
				break;
			case 'single':
				return is_singular( 'product' );
				break;
			case 'cart':
				return function_exists( 'is_cart' ) && is_cart();
				break;
			case 'checkout':
				return function_exists( 'is_checkout' ) && is_checkout();
				break;
			case 'account':
				return function_exists( 'is_account_page' ) && is_account_page();
				break;
			case 'category':
				return function_exists( 'is_product_category' ) && is_product_category();
				break;
			case 'tag':
				return function_exists( 'is_product_tag' ) && is_product_tag();
				break;
			case 'any':
				return (
					function_exists( 'is_shop' ) && is_shop() ||
					is_singular( 'product' ) ||
					function_exists( 'is_cart' ) && is_cart() ||
					function_exists( 'is_checkout' ) && is_checkout() ||
					function_exists( 'is_account_page' ) && is_account_page() ||
					function_exists( 'is_product_category' ) && is_product_category() ||
					function_exists( 'is_product_tag' ) && is_product_tag()
				);
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'mildhill_core_get_woo_main_page_classes' ) ) {
	/**
	 * Function that return current WooCommerce page class name
	 *
	 * @return string
	 */
	function mildhill_core_get_woo_main_page_classes() {
		$classes = array();

		if ( mildhill_core_is_woo_page( 'shop' ) ) {
			$classes[] = 'qodef--list';
		}

		if ( mildhill_core_is_woo_page( 'single' ) ) {
			$classes[] = 'qodef--single';

			if ( mildhill_core_get_post_value_through_levels( 'qodef_woo_single_enable_image_lightbox' ) === 'magnific-popup' ) {
				$classes[] = 'qodef-magnific-popup qodef-popup-gallery';
			}
		}

		if ( mildhill_core_is_woo_page( 'cart' ) ) {
			$classes[] = 'qodef--cart';
		}

		if ( mildhill_core_is_woo_page( 'checkout' ) ) {
			$classes[] = 'qodef--checkout';
		}

		if ( mildhill_core_is_woo_page( 'account' ) ) {
			$classes[] = 'qodef--account';
		}

		return apply_filters( 'mildhill_core_filter_main_page_classes', implode( ' ', $classes ) );
	}
}

if ( ! function_exists( 'mildhill_core_woo_get_global_product' ) ) {
	/**
	 * Function that return global WooCommerce object
	 *
	 * @return object
	 */
	function mildhill_core_woo_get_global_product() {
		global $product;

		return $product;
	}
}

if ( ! function_exists( 'mildhill_core_woo_get_main_shop_page_id' ) ) {
	/**
	 * Function that return main shop page ID
	 *
	 * @return int
	 */
	function mildhill_core_woo_get_main_shop_page_id() {
		// Get page id from options table
		$shop_id = get_option( 'woocommerce_shop_page_id' );

		if ( ! empty( $shop_id ) ) {
			return $shop_id;
		}

		return false;
	}
}

if ( ! function_exists( 'mildhill_core_woo_set_main_shop_page_id' ) ) {
	/**
	 * Function that set main shop page ID for get_post_meta options
	 *
	 * @param $post_id int
	 *
	 * @return int
	 */
	function mildhill_core_woo_set_main_shop_page_id( $post_id ) {

		if ( mildhill_core_is_woo_page( 'shop' ) || mildhill_core_is_woo_page( 'single' ) ) {
			$shop_id = mildhill_core_woo_get_main_shop_page_id();

			if ( ! empty( $shop_id ) ) {
				$post_id = $shop_id;
			}
		}

		return $post_id;
	}

	add_filter( 'mildhill_filter_page_id', 'mildhill_core_woo_set_main_shop_page_id' );
	add_filter( 'qode_framework_filter_page_id', 'mildhill_core_woo_set_main_shop_page_id' );
}

if ( ! function_exists( 'mildhill_core_woo_set_page_title_text' ) ) {
	/**
	 * Function that returns current page title text for WooCommerce pages
	 *
	 * @param $title string
	 *
	 * @return string
	 */
	function mildhill_core_woo_set_page_title_text( $title ) {
		if ( mildhill_core_is_woo_page( 'shop' ) || mildhill_core_is_woo_page( 'single' ) ) {
			$shop_id = mildhill_core_woo_get_main_shop_page_id();

			$title = ! empty( $shop_id ) ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'mildhill-core' );
		} else if ( mildhill_core_is_woo_page( 'category' ) || mildhill_core_is_woo_page( 'tag' ) ) {
			$taxonomy_slug = mildhill_core_is_woo_page( 'tag' ) ? 'product_tag' : 'product_cat';
			$taxonomy      = get_term( get_queried_object_id(), $taxonomy_slug );

			if ( ! empty( $taxonomy ) ) {
				$title = esc_html( $taxonomy->name );
			}
		}

		return $title;
	}

	add_filter( 'mildhill_filter_page_title_text', 'mildhill_core_woo_set_page_title_text' );
}

if ( ! function_exists( 'mildhill_core_woo_single_add_theme_supports' ) ) {
	/**
	 * Function that add native WooCommerce supports
	 */
	function mildhill_core_woo_single_add_theme_supports() {
		// Add featured image zoom functionality on product single page
		$is_zoom_enabled = mildhill_core_get_post_value_through_levels( 'qodef_woo_single_enable_image_zoom' ) !== 'no';

		if ( $is_zoom_enabled ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}

		// Add photo swipe lightbox functionality on product single images page
		$is_photo_swipe_enabled = mildhill_core_get_post_value_through_levels( 'qodef_woo_single_enable_image_lightbox' ) === 'photo-swipe';

		if ( $is_photo_swipe_enabled ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}

	add_action( 'wp_loaded', 'mildhill_core_woo_single_add_theme_supports', 11 ); // permission 11 is set because options are init with permission 10 inside framework plugin
}

if ( ! function_exists( 'mildhill_core_woo_single_disable_page_title' ) ) {
	/**
	 * Function that disable page title area for single product page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function mildhill_core_woo_single_disable_page_title( $enable_page_title ) {
		$is_enabled = mildhill_core_get_post_value_through_levels( 'qodef_woo_single_enable_page_title' ) !== 'no';

		if ( ! $is_enabled && mildhill_core_is_woo_page( 'single' ) ) {
			$enable_page_title = false;
		}

		return $enable_page_title;
	}

	add_filter( 'mildhill_filter_enable_page_title', 'mildhill_core_woo_single_disable_page_title' );
}

if ( ! function_exists( 'mildhill_core_woo_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param $position int
	 * @param $map string
	 *
	 * @return int
	 */
	function mildhill_core_woo_set_admin_options_map_position( $position, $map ) {

		if ( $map === 'woocommerce' ) {
			$position = 70;
		}

		return $position;
	}

	add_filter( 'mildhill_core_filter_admin_options_map_position', 'mildhill_core_woo_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'mildhill_core_include_woocommerce_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function mildhill_core_include_woocommerce_shortcodes() {
		foreach ( glob( MILDHILL_CORE_INC_PATH . '/woocommerce/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'mildhill_core_include_woocommerce_shortcodes' );
}

if ( ! function_exists( 'mildhill_core_add_review_form_fields' ) ) {
	/**
	 * Function that override default wordpress comment form fields
	 *
	 * @param $args array
	 *
	 * @return array
	 */
	function mildhill_core_add_review_form_fields( $args ) {
		if ( function_exists( 'mildhill_comment_form_args' ) ) {
			$args = array_merge( $args, mildhill_comment_form_args() );

			if ( wc_review_ratings_enabled() ) {
				$args['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'mildhill-core' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'mildhill-core' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'mildhill-core' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'mildhill-core' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'mildhill-core' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'mildhill-core' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'mildhill-core' ) . '</option>
					</select></div>';
			}
		}

		$args['comment_field'] .= '<textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Review', 'mildhill-core' ) . '" rows="8" aria-required="true"></textarea>';

		return $args;
	}

	add_filter( 'woocommerce_product_review_comment_form_args', 'mildhill_core_add_review_form_fields' );
}

if ( ! function_exists( 'mildhill_core_set_woo_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function mildhill_core_set_woo_custom_sidebar_name( $sidebar_name ) {
		// check local/meta and global vars on shop page
		if ( mildhill_core_is_woo_page( 'shop' ) || mildhill_core_is_woo_page( 'category' ) || mildhill_core_is_woo_page( 'tag' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_woo_product_list_custom_sidebar' );

			if ( isset( $option ) && ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'mildhill_filter_sidebar_name', 'mildhill_core_set_woo_custom_sidebar_name' );
}

if ( ! function_exists( 'mildhill_core_set_woo_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function mildhill_core_set_woo_sidebar_layout( $layout ) {
		// check local/meta and global vars on shop page
		if ( mildhill_core_is_woo_page( 'shop' ) || mildhill_core_is_woo_page( 'category' ) || mildhill_core_is_woo_page( 'tag' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_woo_product_list_sidebar_layout' );

			if ( isset( $option ) && ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	add_filter( 'mildhill_filter_sidebar_layout', 'mildhill_core_set_woo_sidebar_layout' );
}

if ( ! function_exists( 'mildhill_core_set_woo_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function mildhill_core_set_woo_sidebar_grid_gutter_classes( $classes ) {
		// check local/meta and global vars on shop page
		if ( mildhill_core_is_woo_page( 'shop' ) || mildhill_core_is_woo_page( 'category' ) || mildhill_core_is_woo_page( 'tag' ) ) {
			$option = mildhill_core_get_post_value_through_levels( 'qodef_woo_product_list_sidebar_grid_gutter' );

			if ( isset( $option ) && ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'mildhill_filter_grid_gutter_classes', 'mildhill_core_set_woo_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'mildhill_core_woo_set_product_single_styles' ) ) {
	/**
	 * Function that generates product single inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function mildhill_core_woo_set_product_single_styles( $style ) {
		$id           = get_the_ID();
		$image_styles = array();

		$image_background_color = mildhill_core_get_post_value_through_levels( 'qodef_product_background_color', $id );

		if ( ! empty( $image_background_color ) ) {
			$image_styles['background-color'] = $image_background_color;
		}

		if ( ! empty( $image_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-woo-page.qodef--single .qodef-woo-single-image figure img', $image_styles );
		}

		return $style;
	}

	add_filter( 'mildhill_filter_add_inline_style', 'mildhill_core_woo_set_product_single_styles' );
}

if ( ! function_exists( 'mildhill_core_woo_rename_product_single_tabs' ) ) {
	function mildhill_core_woo_rename_product_single_tabs( $tabs ) {
		$tabs['additional_information']['title'] = esc_html__( 'Additional Info', 'mildhill-core' );

		return $tabs;
	}

	add_filter( 'woocommerce_product_tabs', 'mildhill_core_woo_rename_product_single_tabs', 98 );
}

//Add new custom field

function mildhill_woo_taxonomy_add_new_meta_field() {
	?>

    <div class="form-field">
        <label for="remove_category_from_filter"><?php esc_html_e( 'Remove category from product list filter', 'mildhill-core' ); ?></label>
        <select id="remove_category_from_filter" name="remove_category_from_filter" class="postform">
            <option value="no"><?php esc_html_e( 'No', 'mildhill-core' ); ?></option>
            <option value="yes"><?php esc_html_e( 'Yes', 'mildhill-core' ); ?></option>
        </select>
        <p class="description"><?php esc_html_e( 'Will remove category from filter on product list', 'mildhill-core' ); ?></p>
    </div>
	<?php
}

add_action( 'product_cat_add_form_fields', 'mildhill_woo_taxonomy_add_new_meta_field', 10, 2 );

//Edit new custom field

function mildhill_woo_taxonomy_edit_meta_field( $term ) {

	$remove_from_filter = get_term_meta( $term->term_id, 'remove_category_from_filter', true );
	?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label><?php esc_html_e( 'Remove category from product list filter', 'mildhill-core' ); ?></label></th>
        <td>
            <select id="remove_category_from_filter" name="remove_category_from_filter" class="postform">
                <option value="no" <?php selected( 'no', $remove_from_filter ); ?>><?php esc_html_e( 'No', 'mildhill-core' ); ?></option>
                <option value="yes" <?php selected( 'yes', $remove_from_filter ); ?>><?php esc_html_e( 'Yes', 'mildhill-core' ); ?></option>
            </select>
            <p class="description"><?php esc_html_e( 'Will remove category from filter on product list', 'mildhill-core' ); ?></p>
        </td>
    </tr>
	<?php
}

add_action( 'product_cat_edit_form_fields', 'mildhill_woo_taxonomy_edit_meta_field', 10, 2 );


// Save extra taxonomy fields callback function.
function mildhill_woo_save_taxonomy_custom_meta( $term_id ) {
	$remove_from_filter = filter_input( INPUT_POST, 'remove_category_from_filter' );

	update_term_meta( $term_id, 'remove_category_from_filter', $remove_from_filter );
}

add_action( 'edited_product_cat', 'mildhill_woo_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_product_cat', 'mildhill_woo_save_taxonomy_custom_meta', 10, 2 );
