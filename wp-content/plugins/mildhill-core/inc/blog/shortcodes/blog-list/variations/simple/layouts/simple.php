<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params ); ?>
		<div class="qodef-e-content">
			<?php mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params ); ?>
			<div class="qodef-e-info qodef-info--bottom">
				<?php
				// Include post date info
				mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/date' );
				?>
			</div>
		</div>
	</div>
</article>