<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ) ?>>
		<div class="qodef-e-image">
			<?php mildhill_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<?php mildhill_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
            <?php mildhill_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
		</div>
	</div>
</article>