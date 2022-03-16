<?php

$styles = array();

if ( ! empty( $params['cart_dropdown_icon_size'] ) ) {
	if ( qode_framework_string_ends_with( $params['cart_dropdown_icon_size'], 'px' ) ) {
		$px = '';
	} else {
		$px = 'px';
	}
	$styles[] = 'font-size:' . $params['cart_dropdown_icon_size'] . $px;
	$styles[] = 'height:' . $params['cart_dropdown_icon_size'] . $px; // to control svg height
}

if ( ! empty( $params['cart_dropdown_color'] ) ) {
	$styles[] = 'color: ' . $params['cart_dropdown_color'] . ';';
}

if ( ! empty( $params['cart_dropdown_margin'] ) ) {
	$styles[] = 'margin: ' . $params['cart_dropdown_margin'];
}

?>

<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
        itemprop="url"
        class="qodef-m-opener qodef-opener-widget <?php echo mildhill_core_get_open_close_icon_class( 'qodef_cart_dropdown_icon_source', 'qodef-opener-widget' ); ?>"
	<?php qode_framework_inline_attr( $params['cart_dropdown_hover_color'], 'data-hover-color' ); ?>
	<?php qode_framework_inline_style( $styles ); ?> >

    <span class="qodef-m-icon">
       	<?php echo mildhill_core_get_cart_dropdown_icon_html(); ?>
    </span>

	<?php if ( $params['cart_dropdown_label'] === 'yes' ) : ?>
        <span class="qodef-m-label">
                        <?php esc_html_e( 'Cart', 'mildhill-core' ); ?>
                    </span>
	<?php endif; ?>
</a>