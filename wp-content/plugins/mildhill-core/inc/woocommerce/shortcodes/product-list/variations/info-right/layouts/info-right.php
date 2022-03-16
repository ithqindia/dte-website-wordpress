<div <?php wc_product_class( $item_classes ); ?>>
    <div class="qodef-woo-product-inner">
		<div class="qodef-woo-product-content-outer">
			<?php if ( has_post_thumbnail() ) { ?>
                <div class="qodef-woo-product-image">
					<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
                    <div class="qodef-woo-product-image-inner">
						<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart', '', $params ); ?>
                    </div>
                </div>
			<?php } ?>
            <div class="qodef-woo-product-content">
                <div class="qodef-woo-product-title-price-holder">
					<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
					<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
                </div>
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
            </div>
        </div>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/countdown', '', $params ); ?>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>

</div>