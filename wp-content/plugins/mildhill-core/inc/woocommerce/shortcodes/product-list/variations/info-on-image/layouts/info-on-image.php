<div <?php wc_product_class( $item_classes ); ?>>
    <div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="qodef-woo-product-image">
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/on-sale' ); ?>
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
                <div class="qodef-woo-product-image-inner">
					<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' ); ?>
                    <div class="qodef-woo-product-title-price-holder">
						<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
						<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
                    </div>
                </div>
            </div>
		<?php } ?>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/countdown', '', $params ); ?>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/background-color' ); ?>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>
</div>