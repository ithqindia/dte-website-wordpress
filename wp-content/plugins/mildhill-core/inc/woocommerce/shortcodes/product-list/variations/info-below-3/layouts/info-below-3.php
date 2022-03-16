<div <?php wc_product_class( $item_classes ); ?>>
    <div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="qodef-woo-product-image">
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/on-sale' ); ?>
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
            </div>
		<?php } ?>
        <div class="qodef-woo-product-content" <?php qode_framework_inline_style( $content_styles ); ?>>
            <div class="qodef-woo-product-title-price-holder">
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
            </div>
            <div class="qodef-woo-product-base-price-rating-holder">
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/base-price', '', $params ); ?>
				<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
            </div>
			<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' ); ?>
        </div>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/countdown', '', $params ); ?>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/background-color' ); ?>
		<?php mildhill_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>
</div>