<div class="qodef-m-fragments">
    <span class="qodef-m-opener-count"><?php echo WC()->cart->cart_contents_count; ?></span>
    <div class="qodef-m-dropdown">
        <div class="qodef-m-dropdown-inner">
			<?php if ( ! WC()->cart->is_empty() ) {
				mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/loop' );

				mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/order-details' );

				mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/button' );
			} else {
				mildhill_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/posts-not-found' );
			} ?>
        </div>
    </div>
</div>