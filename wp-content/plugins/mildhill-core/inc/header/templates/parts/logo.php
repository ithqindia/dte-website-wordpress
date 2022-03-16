<a itemprop="url" class="qodef-header-logo-link <?php echo esc_attr( $logo_classes ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php qode_framework_inline_style( $logo_styles ); ?> rel="home">
	<?php echo wp_kses_post( $logo_main_image ); ?>
	<?php echo wp_kses_post( $logo_dark_image ); ?>
	<?php echo wp_kses_post( $logo_light_image ); ?>
</a>