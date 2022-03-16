<?php

/**
 * Global templates hooks
 */

if ( ! function_exists ( 'mildhill_core_add_main_woo_page_template_holder' ) ) {
    /**
     * Function that render additional content for main shop page
     */
    function mildhill_core_add_main_woo_page_template_holder () {
        echo '<main id="qodef-page-content" class="qodef-grid qodef-layout--template qodef--no-bottom-space ' . esc_attr ( mildhill_core_get_grid_gutter_classes () ) . '"><div class="qodef-grid-inner clear">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_main_woo_page_template_holder_end' ) ) {
    /**
     * Function that render additional content for main shop page
     */
    function mildhill_core_add_main_woo_page_template_holder_end () {
        echo '</div></main>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_main_woo_page_holder' ) ) {
    /**
     * Function that render additional content around WooCommerce pages
     */
    function mildhill_core_add_main_woo_page_holder () {
        $classes = array ();

        // add class to pages with sidebar and on single page
        if ( mildhill_core_is_woo_page ( 'shop' ) || mildhill_core_is_woo_page ( 'category' ) || mildhill_core_is_woo_page ( 'tag' ) || mildhill_core_is_woo_page ( 'single' ) ) {
            $classes[] = 'qodef-grid-item';
        }

        // add class to pages with sidebar
        if ( mildhill_core_is_woo_page ( 'shop' ) || mildhill_core_is_woo_page ( 'category' ) || mildhill_core_is_woo_page ( 'tag' ) ) {
            $classes[] = mildhill_core_get_page_content_sidebar_classes ();
        }

        $classes[] = mildhill_core_get_woo_main_page_classes ();

        echo '<div id="qodef-woo-page" ' . qode_framework_get_class_attribute ( $classes ) . '>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_main_woo_page_holder_end' ) ) {
    /**
     * Function that render additional content around WooCommerce pages
     */
    function mildhill_core_add_main_woo_page_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_main_woo_page_sidebar_holder' ) ) {
    /**
     * Function that render sidebar layout for main shop page
     */
    function mildhill_core_add_main_woo_page_sidebar_holder () {
        if ( ! is_singular ( 'product' ) ) {
            // Include page content sidebar
            mildhill_core_theme_template_part ( 'sidebar', 'templates/sidebar' );
        }
    }
}

/**
 * Shop page templates hooks
 */

if ( ! function_exists ( 'mildhill_core_add_results_and_ordering_holder' ) ) {
    /**
     * Function that render additional content around results and ordering templates on main shop page
     */
    function mildhill_core_add_results_and_ordering_holder () {
        echo '<div class="qodef-woo-results">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_results_and_ordering_holder_end' ) ) {
    /**
     * Function that render additional content around results and ordering templates on main shop page
     */
    function mildhill_core_add_results_and_ordering_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_holder' ) ) {
    /**
     * Function that render additional content around product list item on main shop page
     */
    function mildhill_core_add_product_list_item_holder () {
        echo '<div class="qodef-woo-product-inner">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_holder_end' ) ) {
    /**
     * Function that render additional content around product list item on main shop page
     */
    function mildhill_core_add_product_list_item_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_image_holder' ) ) {
    /**
     * Function that render additional content around image template on main shop page
     */
    function mildhill_core_add_product_list_item_image_holder () {
        echo '<div class="qodef-woo-product-image">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_image_holder_end' ) ) {
    /**
     * Function that render additional content around image template on main shop page
     */
    function mildhill_core_add_product_list_item_image_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_additional_image_holder' ) ) {
    /**
     * Function that render additional content around image and sale templates on main shop page
     */
    function mildhill_core_add_product_list_item_additional_image_holder () {
        echo '<div class="qodef-woo-product-image-inner">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_additional_image_holder_end' ) ) {
    /**
     * Function that render additional content around image and sale templates on main shop page
     */
    function mildhill_core_add_product_list_item_additional_image_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_content_holder' ) ) {
    /**
     * Function that render additional content around product info on main shop page
     */
    function mildhill_core_add_product_list_item_content_holder () {
        echo '<div class="qodef-woo-product-content">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_content_holder_end' ) ) {
    /**
     * Function that render additional content around product info on main shop page
     */
    function mildhill_core_add_product_list_item_content_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_content_outer_holder' ) ) {
    /**
     * Function that render additional content around product info on main shop page
     */
    function mildhill_core_add_product_list_item_content_outer_holder () {
        echo '<div class="qodef-woo-product-content-outer">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_content_outer_holder_end' ) ) {
    /**
     * Function that render additional content around product info on main shop page
     */
    function mildhill_core_add_product_list_item_content_outer_holder_end () {
        echo '</div>';
    }
}

//if ( ! function_exists( 'mildhill_core_add_product_list_item_categories' ) ) {
//	/**
//	 * Function that render product categories
//	 */
//	function mildhill_core_add_product_list_item_categories() {
//		mildhill_core_woo_render_product_categories( '<div class="qodef-woo-product-categories">', '</div>' );
//	}
//}

/**
 * Product single page templates hooks
 */

if ( ! function_exists ( 'mildhill_core_add_product_single_content_holder' ) ) {
    /**
     * Function that render additional content around image and summary templates on single product page
     */
    function mildhill_core_add_product_single_content_holder () {
        echo '<div class="qodef-woo-single-inner">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_single_content_holder_end' ) ) {
    /**
     * Function that render additional content around image and summary templates on single product page
     */
    function mildhill_core_add_product_single_content_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_single_image_holder' ) ) {
    /**
     * Function that render additional content around featured image on single product page
     */
    function mildhill_core_add_product_single_image_holder () {
        echo '<div class="qodef-woo-single-image">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_single_image_holder_end' ) ) {
    /**
     * Function that render additional content around featured image on single product page
     */
    function mildhill_core_add_product_single_image_holder_end () {
        echo '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_woo_product_render_social_share_html' ) ) {
    /**
     * Function that render social share html
     */
    function mildhill_core_woo_product_render_social_share_html () {

        if ( class_exists ( 'MildhillCoreSocialShareShortcode' ) ) {
            $params             = array ();
            $params[ 'layout' ] = 'list';
            $params[ 'title' ]  = esc_html__ ( 'Share:', 'mildhill-core' );

            echo MildhillCoreSocialShareShortcode ::call_shortcode ( $params );
        }
    }
}

/**
 * Override default WooCommerce templates
 */

if ( ! function_exists ( 'mildhill_core_woo_disable_page_heading' ) ) {
    /**
     * Function that disable heading template on main shop page
     *
     * @return bool
     */
    function mildhill_core_woo_disable_page_heading () {
        return false;
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_holder' ) ) {
    /**
     * Function that add additional content around product lists on main shop page
     *
     * @param $html string
     *
     * @return string which contains html content
     */
    function mildhill_core_add_product_list_holder ( $html ) {
        $classes = array ();
        $layout  = mildhill_core_get_post_value_through_levels ( 'qodef_product_list_item_layout' );
        $option  = mildhill_core_get_post_value_through_levels ( 'qodef_woo_product_list_columns_space' );

        if ( ! empty( $layout ) ) {
            $classes[] = 'qodef-item-layout--' . $layout;
        }

        if ( ! empty( $option ) ) {
            $classes[] = 'qodef-gutter--' . $option;
        }

        $classes = implode ( ' ', $classes );

        return '<div class="qodef-woo-product-list ' . esc_attr ( $classes ) . '">' . $html;
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_holder_end' ) ) {
    /**
     * Function that add additional content around product lists on main shop page
     *
     * @param $html string
     *
     * @return string which contains html content
     */
    function mildhill_core_add_product_list_holder_end ( $html ) {
        return $html . '</div>';
    }
}

if ( ! function_exists ( 'mildhill_core_woo_product_list_columns' ) ) {
    /**
     * Function that set number of columns for main shop page
     *
     * @param $columns int
     *
     * @return int
     */
    function mildhill_core_woo_product_list_columns ( $columns ) {
        $option = mildhill_core_get_post_value_through_levels ( 'qodef_woo_product_list_columns' );

        if ( ! empty( $option ) ) {
            $columns = intval ( $option );
        } else {
            $columns = 3;
        }

        return $columns;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_products_per_page' ) ) {
    /**
     * Function that set number of items for main shop page
     *
     * @param $products_per_page int
     *
     * @return int
     */
    function mildhill_core_woo_products_per_page ( $products_per_page ) {
        $option = mildhill_core_get_post_value_through_levels ( 'qodef_woo_product_list_products_per_page' );

        if ( ! empty( $option ) ) {
            $products_per_page = intval ( $option );
        }

        return $products_per_page;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_pagination_args' ) ) {
    /**
     * Function that override pagination args on main shop page
     *
     * @param $args array
     *
     * @return array
     */
    function mildhill_core_woo_pagination_args ( $args ) {
        $args[ 'prev_text' ] = qode_framework_icons () -> render_icon ( 'arrow_carrot-left', 'elegant-icons' );
        $args[ 'next_text' ] = qode_framework_icons () -> render_icon ( 'arrow_carrot-right', 'elegant-icons' );
        $args[ 'type' ]      = 'plain';

        return $args;
    }
}

if ( ! function_exists ( 'mildhill_core_add_single_product_classes' ) ) {
    /**
     * Function that render additional content around WooCommerce pages
     */
    function mildhill_core_add_single_product_classes ( $classes, $class = '', $post_id = 0 ) {
        if ( ! $post_id || ! in_array ( get_post_type ( $post_id ), array ( 'product', 'product_variation' ), true ) ) {
            return $classes;
        }

        $product = wc_get_product ( $post_id );

        if ( $product ) {
            $new = get_post_meta ( $post_id, 'qodef_show_new_sign', true );

            if ( $new === 'yes' ) {
                $classes[] = 'new';
            }
        }

        return $classes;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_sale_flash' ) ) {
    /**
     * Function that override on sale template for product
     *
     * @return string which contains html content
     */
    function mildhill_core_woo_sale_flash ( $shortcode = false, $percent_sign = '' ) {
        $product = mildhill_core_woo_get_global_product ();

        if ( $shortcode && ! empty( $percent_sign ) ) {
            $enable_percent_mark = $percent_sign;
        } else {
            $enable_percent_mark = mildhill_core_get_post_value_through_levels ( 'qodef_woo_product_list_percent_sign' );
        }

        $price      = intval ( $product -> get_regular_price () );
        $sale_price = intval ( $product -> get_sale_price () );

        $html = '';
        $html .= '<span class="qodef-woo-product-mark qodef-woo-onsale">';

        if ( $price > 0 && $enable_percent_mark === 'yes' ) {
            $html .= '-' . ( 100 - round ( ( $sale_price * 100 ) / $price ) ) . '%';
        } else {
            $html .= esc_html__ ( 'Sale', 'mildhill-core' );
        }

        $html .= '</span>';

        //return '<span class="qodef-woo-product-mark qodef-woo-onsale">' . esc_html__( 'Sale', 'mildhill-core' ) . '</span>';

        return $html;
    }
}

if ( ! function_exists ( 'mildhill_core_add_out_of_stock_mark_on_product' ) ) {
    /**
     * Function for adding out of stock template for product
     */
    function mildhill_core_add_out_of_stock_mark_on_product () {
        $product = mildhill_core_woo_get_global_product ();

        if ( ! empty( $product ) && ! $product -> is_in_stock () ) {
            echo mildhill_core_get_out_of_stock_mark ();
        }
    }
}

if ( ! function_exists ( 'mildhill_core_get_out_of_stock_mark' ) ) {
    /**
     * Function for adding out of stock template for product
     *
     * @return string
     */
    function mildhill_core_get_out_of_stock_mark () {
        return '<span class="qodef-woo-product-mark qodef-out-of-stock">' . esc_html__ ( 'Sold', 'mildhill-core' ) . '</span>';
    }
}

if ( ! function_exists ( 'mildhill_core_add_new_mark_on_product' ) ) {
    /**
     * Function for adding out of stock template for product
     */
    function mildhill_core_add_new_mark_on_product () {
        $product = mildhill_core_woo_get_global_product ();

        if ( ! empty( $product ) && $product -> get_id () !== '' ) {
            echo mildhill_core_get_new_mark ( $product -> get_id () );
        }
    }
}

if ( ! function_exists ( 'mildhill_core_get_new_mark' ) ) {
    /**
     * Function for adding out of stock template for product
     *
     * @param $product_id int
     *
     * @return string
     */
    function mildhill_core_get_new_mark ( $product_id ) {
        $option = get_post_meta ( $product_id, 'qodef_show_new_sign', true );

        if ( $option === 'yes' ) {
            return '<span class="qodef-woo-product-mark qodef-new">' . esc_html__ ( 'New', 'mildhill-core' ) . '</span>';
        }

        return false;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_shop_loop_item_title' ) ) {
    /**
     * Function that override product list item title template
     */
    function mildhill_core_woo_shop_loop_item_title () {
        $option    = mildhill_core_get_post_value_through_levels ( 'qodef_woo_product_list_title_tag' );
        $title_tag = ! empty( $option ) ? esc_attr ( $option ) : 'h6';

        echo '<' . $title_tag . ' class="qodef-woo-product-title woocommerce-loop-product__title">' . get_the_title () . '</' . $title_tag . '>';
    }
}

if ( ! function_exists ( 'mildhill_core_woo_template_single_title' ) ) {
    /**
     * Function that override product single item title template
     */
    function mildhill_core_woo_template_single_title () {
        $option    = mildhill_core_get_post_value_through_levels ( 'qodef_woo_single_title_tag' );
        $title_tag = ! empty( $option ) ? esc_attr ( $option ) : 'h2';

        echo '<' . $title_tag . ' class="qodef-woo-product-title product_title entry-title">' . get_the_title () . '</' . $title_tag . '>';
    }
}

if ( ! function_exists ( 'mildhill_core_woo_single_thumbnail_images_columns' ) ) {
    /**
     * Function that set number of columns for thumbnail images on single product page
     *
     * @param $columns int
     *
     * @return int
     */
    function mildhill_core_woo_single_thumbnail_images_columns ( $columns ) {
        $option = mildhill_core_get_post_value_through_levels ( 'qodef_woo_single_thumbnail_images_columns' );

        if ( ! empty( $option ) ) {
            $columns = intval ( $option );
        }

        return $columns;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_single_thumbnail_images_size' ) ) {
    /**
     * Function that set thumbnail images size on single product page
     *
     * @param $size string
     *
     * @return string
     */
    function mildhill_core_woo_single_thumbnail_images_size ( $size ) {
        return apply_filters ( 'mildhill_core_filter_woo_single_thumbnail_size', 'woocommerce_thumbnail' );
    }
}

if ( ! function_exists ( 'mildhill_core_woo_single_related_product_list_columns' ) ) {
    /**
     * Function that set number of columns for related product list on single product page
     *
     * @param $args array
     *
     * @return array
     */
    function mildhill_core_woo_single_related_product_list_columns ( $args ) {
        $option = mildhill_core_get_post_value_through_levels ( 'qodef_woo_single_related_product_list_columns' );

        if ( ! empty( $option ) ) {
            $args[ 'posts_per_page' ] = intval ( $option );
            $args[ 'columns' ]        = intval ( $option );
        }

        return $args;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_product_get_rating_html' ) ) {
    /**
     * Function that override ratings templates
     *
     * @param $html   string - contains html content
     * @param $rating float
     * @param $count  int - total number of ratings
     *
     * @return string
     */
    function mildhill_core_woo_product_get_rating_html ( $html, $rating, $count ) {
        if ( ! empty( $rating ) ) {
            $html = '<div class="qodef-woo-ratings qodef-m"><div class="qodef-m-inner">';
            $html .= '<div class="qodef-m-star qodef--initial">';
            for ( $i = 0 ; $i < 5 ; $i ++ ) {
                $html .= qode_framework_icons () -> render_icon ( 'icon_star_alt', 'elegant-icons' );
            }
            $html .= '</div>';
            $html .= '<div class="qodef-m-star qodef--active" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
            for ( $i = 0 ; $i < 5 ; $i ++ ) {
                $html .= qode_framework_icons () -> render_icon ( 'icon_star', 'elegant-icons' );
            }
            $html .= '</div>';
            $html .= '</div></div>';
        }

        return $html;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_get_product_search_form' ) ) {
    /**
     * Function that override product search widget form
     *
     * @param $html string
     *
     * @return string which contains html content
     */
    function mildhill_core_woo_get_product_search_form ( $html ) {
        return mildhill_core_get_template_part ( 'woocommerce', 'templates/product-searchform' );
    }
}

if ( ! function_exists ( 'mildhill_core_woo_get_content_widget_product' ) ) {
    /**
     * Function that override product content widget
     *
     * @param $located       string
     * @param $template_name string
     * @param $args          array
     * @param $template_path string
     * @param $default_path  string
     *
     * @return string which contains html content
     */
    function mildhill_core_woo_get_content_widget_product ( $located, $template_name, $args, $template_path, $default_path ) {
        if ( $template_name === 'content-widget-product.php' && file_exists ( MILDHILL_CORE_INC_PATH . '/woocommerce/templates/content-widget-product.php' ) ) {
            $located = MILDHILL_CORE_INC_PATH . '/woocommerce/templates/content-widget-product.php';
        }

        return $located;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_get_quantity_input' ) ) {
    /**
     * Function that override quantity input
     *
     * @param $located       string
     * @param $template_name string
     * @param $args          array
     * @param $template_path string
     * @param $default_path  string
     *
     * @return string which contains html content
     */
    function mildhill_core_woo_get_quantity_input ( $located, $template_name, $args, $template_path, $default_path ) {
        if ( $template_name === 'global/quantity-input.php' && file_exists ( MILDHILL_CORE_INC_PATH . '/woocommerce/templates/global/quantity-input.php' ) ) {
            $located = MILDHILL_CORE_INC_PATH . '/woocommerce/templates/global/quantity-input.php';
        }

        return $located;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_get_single_product_meta' ) ) {
    /**
     * Function that override single product meta
     *
     * @param $located       string
     * @param $template_name string
     * @param $args          array
     * @param $template_path string
     * @param $default_path  string
     *
     * @return string which contains html content
     */
    function mildhill_core_woo_get_single_product_meta ( $located, $template_name, $args, $template_path, $default_path ) {
        if ( $template_name === 'single-product/meta.php' && file_exists ( MILDHILL_CORE_INC_PATH . '/woocommerce/templates/single-product/meta.php' ) ) {
            $located = MILDHILL_CORE_INC_PATH . '/woocommerce/templates/single-product/meta.php';
        }

        return $located;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_get_list_shortcode_item_image' ) ) {
    /**
     * Function that override thumbnail img tag for list shortcodes
     *
     * @param $html          string
     * @param $attachment_id int
     *
     * @return string generated img tag
     */
    function mildhill_core_woo_get_list_shortcode_item_image ( $html, $attachment_id ) {
        if ( empty( $attachment_id ) && get_post_type () === 'product' ) {
            $html = woocommerce_get_product_thumbnail ();
        }

        return $html;
    }
}

if ( ! function_exists ( 'mildhill_core_woo_add_product_list_item_background_holder' ) ) {
    function mildhill_core_woo_add_product_list_item_background_holder () {
        $product = mildhill_core_woo_get_global_product ();

        if ( ! empty( get_post_meta ( $product -> get_id (), 'qodef_product_background_color', true ) ) ) {
            $background_color = 'background-color:' . get_post_meta ( $product -> get_id (), 'qodef_product_background_color', true );

            echo '<div class="qodef-woo-product-background" ' . qode_framework_get_inline_style ( $background_color ) . '></div>';
        }
    }
}

if ( ! function_exists ( 'mildhill_core_woo_add_product_list_item_buttons_holder' ) ) {
    function mildhill_core_woo_add_product_list_item_buttons_holder ( $params, $shortcode = false ) {
        if ( function_exists ( 'woocommerce_template_loop_add_to_cart' ) ) { ?>

            <div class="qodef-woo-buttons-holder">

            <?php

            $layout = mildhill_core_get_post_value_through_levels ( 'qodef_product_list_item_layout' );

            if ( isset( $params[ 'layout' ] ) && ( $params[ 'layout' ] === 'info-right' ) || isset( $layout ) && $layout === 'info-right' && ! $shortcode ) {
                woocommerce_template_loop_add_to_cart ();

            } else {
                woocommerce_template_loop_add_to_cart ();
                do_action ( 'mildhill_core_action_woo_yith_buttons' );
            }

        } ?>

        </div>

    <?php }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_title_price_holder' ) ) {
    /**
     * Function that render additional content around title and price
     */
    function mildhill_core_add_product_list_item_title_price_holder () {
        echo '<div class="qodef-woo-product-title-price-holder">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_title_price_holder_end' ) ) {
    /**
     * Function that render additional content around title and price
     */
    function mildhill_core_add_product_list_item_title_price_holder_end () {
        echo '</div>';
    }
}


if ( ! function_exists ( 'mildhill_core_woo_product_get_base_price_html' ) ) {
    /**
     * Function that render base price in format 100$/kg
     *
     * @param $raw_price  integer/float - product price
     * @param $base_price integer/float - product base price ratio
     * @param $base_unit  string - product unit of measurement
     */
    function mildhill_core_woo_product_get_base_price_html () {
        $product = mildhill_core_woo_get_global_product ();
        $html    = '';

        $raw_price  = $product -> get_price ();
        $base_price = get_post_meta ( $product -> get_id (), 'qodef_product_base_price', true );
        $base_unit  = get_post_meta ( $product -> get_id (), 'qodef_product_base_unit', true );

        if ( ! empty( $raw_price ) && ! empty( $base_price ) && ! empty( $base_unit ) ) {
            $html .= '<div class="qodef-woo-product-base-price">';
            $html .= sprintf ( get_woocommerce_price_format (), get_woocommerce_currency_symbol (), number_format ( ( $raw_price * $base_price ), wc_get_price_decimals (), wc_get_price_decimal_separator (), wc_get_price_thousand_separator () ) ) . ' / ' . $base_unit;
            $html .= '</div>';
        }

        echo $html;
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_base_price_rating_holder' ) ) {
    /**
     * Function that render additional content around base price and rating
     */
    function mildhill_core_add_product_list_item_base_price_rating_holder () {
        echo '<div class="qodef-woo-product-base-price-rating-holder">';
    }
}

if ( ! function_exists ( 'mildhill_core_add_product_list_item_base_price_rating_holder_end' ) ) {
    /**
     * Function that render additional content around base price and rating
     */
    function mildhill_core_add_product_list_item_base_price_rating_holder_end () {
        echo '</div>';
    }
}