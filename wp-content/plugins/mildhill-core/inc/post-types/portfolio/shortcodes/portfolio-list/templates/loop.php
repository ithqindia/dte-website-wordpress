<?php
if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();
		$params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );

		mildhill_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'layouts/' . $layout, '', $params );
	endwhile; // End of the loop.
} else {
	mildhill_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/posts-not-found' );
}

wp_reset_postdata();