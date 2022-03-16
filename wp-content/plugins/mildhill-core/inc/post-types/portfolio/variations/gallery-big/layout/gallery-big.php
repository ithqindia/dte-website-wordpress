<article <?php post_class( 'qodef-portfolio-single-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-media">
			<?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'gallery'); ?>
        </div>
        <div class="qodef-e-content qodef-grid qodef-layout--template qodef-gutter--small">
            <div class="qodef-grid-inner clear">
                <div class="qodef-grid-item qodef-col--8">
					<?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
                </div>
                <div class="qodef-grid-item qodef-col--4 qodef-portfolio-info">
					<?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
                    <?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
                    <?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
                    <?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
					<?php mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
                </div>
            </div>
        </div>
    </div>
	<?php mildhill_core_template_part( 'post-types/portfolio', 'single-navigation/templates/single-navigation' ); ?>
</article>