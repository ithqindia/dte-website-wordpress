<?php

// TODO check what actually is empty var
if ( $categories !== '' ) {
	foreach ( $categories as $category ) {
		$params['category_slug']   = $category->slug;
		$params['category_name']   = $category->name;
		$params['category_id']     = $category->term_id;
		$params['image_dimension'] = $this_shortcode->get_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );

		mildhill_core_list_sc_template_part( 'woocommerce/shortcodes/product-categories-list', 'layouts/' . $layout, '', $params );
	}
} else {
	mildhill_core_template_part( 'woocommerce/shortcodes/product-categories-list', 'templates/posts-not-found' );
}