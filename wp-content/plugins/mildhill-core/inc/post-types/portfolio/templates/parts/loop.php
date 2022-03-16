<?php

if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		
		// Hook to include additional content before blog post item
		do_action( 'mildhill_core_action_before_portfolio_item' );
		
		$item_layout = apply_filters( 'mildhill_core_filter_portfolio_single_layout', array() );
		
		// Include post item
		mildhill_core_template_part( 'post-types/portfolio', 'variations/'.$item_layout.'/layout/' . $item_layout );
		
		// Hook to include additional content after blog post item
		do_action( 'mildhill_core_action_after_portfolio_item' );
	
	endwhile; // End of the loop.
} else {
	// Include posts not found
	mildhill_core_template_part( 'post-types/portfolio', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();