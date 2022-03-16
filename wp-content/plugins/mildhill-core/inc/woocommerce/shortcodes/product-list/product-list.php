<?php

if ( ! function_exists ( 'mildhill_core_add_product_list_shortcode' ) ) {
    /**
     * Function that is adding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function mildhill_core_add_product_list_shortcode ( $shortcodes ) {
        $shortcodes[] = 'MildhillCoreProductListShortcode';

        return $shortcodes;
    }

    add_filter ( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_product_list_shortcode' );
}

if ( class_exists ( 'MildhillCoreListShortcode' ) ) {
    class MildhillCoreProductListShortcode extends MildhillCoreListShortcode
    {

        public function __construct () {
            $this -> set_post_type ( 'product' );
            $this -> set_post_type_taxonomy ( 'product_cat' );
            $this -> set_post_type_additional_taxonomies ( array ( 'product_tag', 'product_type' ) );
            $this -> set_layouts ( apply_filters ( 'mildhill_core_filter_product_list_layouts', array () ) );
            $this -> set_extra_options ( apply_filters ( 'mildhill_core_filter_product_list_extra_options', array () ) );

            parent ::__construct ();
        }

        public function map_shortcode () {
            $this -> set_shortcode_path ( MILDHILL_CORE_INC_URL_PATH . '/woocommerce/shortcodes/product-list' );
            $this -> set_base ( 'mildhill_core_product_list' );
            $this -> set_name ( esc_html__ ( 'Product List', 'mildhill-core' ) );
            $this -> set_description ( esc_html__ ( 'Shortcode that displays list of products', 'mildhill-core' ) );
            $this -> set_category ( esc_html__ ( 'Mildhill Core', 'mildhill-core' ) );
            $this -> set_option ( array (
                'field_type' => 'text',
                'name'       => 'custom_class',
                'title'      => esc_html__ ( 'Custom Class', 'mildhill-core' ),
            ) );
            $this -> set_option ( array (
                'field_type'  => 'select',
                'name'        => 'percent_sign',
                'title'       => esc_html__ ( 'Enable Percent Sign', 'mildhill-core' ),
                'description' => esc_html__ ( 'Applied to simple and external types of products', 'mildhill-core' ),
                'options'     => mildhill_core_get_select_type_options_pool ( 'yes_no' ),
                'group'       => esc_html__ ( 'Layout', 'mildhill-core' ),
            ) );
            $this -> set_option ( array (
                'field_type' => 'select',
                'name'       => 'countdown',
                'title'      => esc_html__ ( 'Enable Sales Countdown', 'mildhill-core' ),
                'options'    => mildhill_core_get_select_type_options_pool ( 'yes_no' ),
                'group'      => esc_html__ ( 'Layout', 'mildhill-core' ),
            ) );
            $this -> map_list_options ();
            $this -> map_query_options ( array ( 'post_type' => $this -> get_post_type () ) );
            $this -> map_layout_options ( array ( 'layouts' => $this -> get_layouts () ) );

            $this -> set_option ( array (
                'field_type' => 'text',
                'name'       => 'content_top_margin',
                'title'      => esc_html__ ( 'Content Top Margin', 'mildhill-core' ),
                'group'      => esc_html__ ( 'Layout', 'mildhill-core' ),
                'dependency' => array (
                    'show' => array (
                        'layout' => array (
                            'values'        => array ( 'info-below-1', 'info-below-2', 'info-below-3' ),
                            'default_value' => 'info-below-1',
                        ),
                    ),
                ),
            ) );

            $this -> map_additional_options ();
            $this -> map_extra_options ();
        }

        public static function call_shortcode ( $params ) {
            $html = qode_framework_call_shortcode ( 'mildhill_core_product_list', $params );
            $html = str_replace ( "\n", '', $html );

            return $html;
        }

        public function render ( $options, $content = null ) {
            parent ::render ( $options );

            $atts = $this -> get_atts ();

            $atts[ 'post_type' ]       = $this -> get_post_type ();
            $atts[ 'taxonomy_filter' ] = $this -> get_post_type_taxonomy ();

            // Additional query args
            $atts[ 'additional_query_args' ] = $this -> get_additional_query_args ( $atts );

            $atts[ 'holder_classes' ] = $this -> get_holder_classes ( $atts );
            $atts[ 'query_result' ]   = new \WP_Query( mildhill_core_get_query_params ( $atts ) );
            $atts[ 'slider_attr' ]    = $this -> get_slider_data ( $atts );
            $atts[ 'data_attr' ]      = mildhill_core_get_pagination_data ( MILDHILL_CORE_REL_PATH, 'woocommerce/shortcodes', 'product-list', 'product', $atts );

            $atts[ 'this_shortcode' ] = $this;

            return mildhill_core_get_template_part ( 'woocommerce/shortcodes/product-list', 'templates/content', $atts[ 'behavior' ], $atts );
        }

        private function get_holder_classes ( $atts ) {
            $holder_classes = $this -> init_holder_classes ();

            $holder_classes[] = 'qodef-woo-shortcode';
            $holder_classes[] = 'qodef-woo-product-list';
            $holder_classes[] = ! empty( $atts[ 'layout' ] ) ? 'qodef-item-layout--' . $atts[ 'layout' ] : '';

            $list_classes   = $this -> get_list_classes ( $atts );
            $holder_classes = array_merge ( $holder_classes, $list_classes );

            return implode ( ' ', $holder_classes );
        }

        public function get_item_classes ( $atts ) {
            $item_classes      = $this -> init_item_classes ();
            $list_item_classes = $this -> get_list_item_classes ( $atts );

            $item_classes = array_merge ( $item_classes, $list_item_classes );

            return implode ( ' ', $item_classes );
        }

        public function get_title_styles ( $atts ) {
            $styles = array ();

            if ( ! empty( $atts[ 'text_transform' ] ) ) {
                $styles[] = 'text-transform: ' . $atts[ 'text_transform' ];
            }

            return $styles;
        }

        public function get_content_styles ( $atts ) {
            $styles = array ();

            if ( ! empty( $atts[ 'content_top_margin' ] ) ) {
                $styles[] = 'margin-top: ' . $atts[ 'content_top_margin' ];
            }

            return $styles;
        }
    }
}