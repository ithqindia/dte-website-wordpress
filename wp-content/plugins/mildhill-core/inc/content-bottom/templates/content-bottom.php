<div id="qodef-page-content-bottom">
	<?php
	// hook to include additional content before page content bottom content
	do_action( 'mildhill_core_action_before_page_content_bottom_content' );

	// include module content template
	echo apply_filters( 'mildhill_core_filter_content_bottom_content_template', mildhill_core_get_template_part( 'content-bottom', 'templates/content-bottom-content' ) );

	// hook to include additional content after page content bottom  content
	do_action( 'mildhill_core_action_after_page_content_bottom_content' );
	?>
</div>