<?php

/**
 * Flatsome theme compatibility Class
 *
 * @since 4.6.18
 */
class Iconic_WooThumbs_Compat_Flatsome {
	/**
	 * Init.
	 */
	public static function run() {
		$theme = wp_get_theme();

		if ( $theme->template !== 'flatsome' ) {
			return;
		}

		add_action( 'woocommerce_before_single_product_lightbox_summary', array( __CLASS__, 'add_qv_images' ), 0 );
	}

	/**
	 * Add WooThumbs gallery to QV.
	 */
	public static function add_qv_images() {
		$styles = apply_filters( 'iconic_woothumbs_flatsome_qv_styles', array(
			'.woothumbs-gallery-quick-view .iconic-woothumbs-all-images-wrap' => array(
				'width' => '100%',
			),
			'.woothumbs-gallery-quick-view .ast-oembed-container'             => array(
				'padding'  => 0,
				'position' => 'absolute',
				'top'      => 0,
				'left'     => 0,
				'bottom'   => 0,
				'right'    => 0,
			),
		) );
		?>
		<div class="woothumbs-gallery-quick-view" style="max-width: 488px;">
			<?php echo do_shortcode( '[woothumbs-gallery]' ); ?>
			<script type="text/javascript">
				// Remove the theme gallery
				jQuery( '.product-lightbox.lightbox-content .product-gallery-slider' ).remove();
				jQuery( '.product-lightbox.lightbox-content .iconic-woothumbs-images__slide img:first' ).load( function(){
					jQuery( 'body' ).trigger( 'jckqv_open' );
				} );
			</script>
			<?php if ( ! empty( $styles ) ) { ?>
				<style>
					<?php foreach( $styles as $property => $params ) { ?>
						<?php echo $property; ?> {
							<?php foreach( $params as $key => $value ) { ?>
								<?php echo $key; ?>: <?php echo $value; ?>;
							<?php } ?>
						}
					<?php } ?>
				</style>
			<?php } ?>
		</div>
		<?php
	}
}