<div class="qodef-m-image">
	<?php echo wp_get_attachment_image( $image, 'full' ); ?>
	<?php if ( $link !== '' ) { ?>
        <a class="qodef-team-link" href="<?php echo esc_url( $link ) ?>" target="<?php echo esc_attr( $target ) ?>"></a>
	<?php } ?>
</div>

