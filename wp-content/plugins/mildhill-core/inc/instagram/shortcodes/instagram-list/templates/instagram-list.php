<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style($content_styles);?>>
	<?php echo do_shortcode( "[instagram-feed $instagram_params]" ); // XSS OK ?>
</div>