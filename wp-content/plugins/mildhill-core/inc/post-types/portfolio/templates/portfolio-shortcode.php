<div class="qodef-grid-item <?php echo esc_attr( mildhill_core_get_page_content_sidebar_classes() ); ?>">
	<?php
		$queried_tax = get_queried_object();
		$tax         = $queried_tax->taxonomy;
		$tax_slug    = $queried_tax->slug;
		
		mildhill_core_generate_portfolio_archive_with_shortcode( $tax, $tax_slug );
	?>
</div>