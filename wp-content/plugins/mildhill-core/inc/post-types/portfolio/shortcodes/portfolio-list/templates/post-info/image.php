<?php
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty ( $portfolio_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$style = '';
	if ( ! empty( $info_below_content_margin_top ) ) {
		$style = 'margin-bottom:' . ( qode_framework_string_ends_with( $info_below_content_margin_top, 'px' ) ? $info_below_content_margin_top : intval( $info_below_content_margin_top ) . 'px' );
	}

	$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && $custom_image_width !== '' ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && $custom_image_height !== '' ? intval( $custom_image_height ) : 0;
	?>
    <div class="qodef-e-media-image" <?php qode_framework_inline_style( $style ); ?> >
        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php echo mildhill_core_get_list_shortcode_item_image( $image_dimension, $portfolio_list_image, $custom_image_width, $custom_image_height ); ?>
        </a>
    </div>
<?php } ?>