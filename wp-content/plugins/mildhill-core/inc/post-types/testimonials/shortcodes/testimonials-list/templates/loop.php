<?php if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();
		mildhill_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'layouts/' . $layout, '', $params );
	endwhile; // End of the loop.
} else {
	mildhill_core_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/posts-not-found' );
}

wp_reset_postdata();