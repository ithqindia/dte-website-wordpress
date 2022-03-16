<article <?php post_class( $item_classes ); ?>>
    <div class="qodef-e-inner">
		<?php
		// Include post media
		mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params );
		?>
		<?php /*mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/link' ); */ ?>
        <div class="qodef-e-content">
            <div class="qodef-e-text">
                <div class="qodef-e-info qodef-info--top">
					<?php
					// Include post category and date
					mildhill_core_theme_template_part( 'blog', 'templates/parts/post-info/category-and-date' ); ?>
                </div>

				<?php
				// Include post date
				/*mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/date' );
				mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/author' );*/
				//mildhill_core_theme_template_part( 'blog', 'templates/parts/post-info/category-and-date' );


				// Include post title
				mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );

				// Include post excerpt
				mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/excerpt', '', $params ); ?>

                <div class="qodef-e-info qodef-info--bottom">
					<?php
					// Include post read more
					mildhill_template_part( 'blog', 'templates/parts/post-info/read-more' );
					?>
                </div>

				<?php
				// Hook to include additional content after blog single content
				do_action( 'mildhill_action_after_blog_single_content' );
				?>
            </div>
        </div>

    </div>
</article>