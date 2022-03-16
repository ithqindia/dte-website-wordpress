<div id="qodef-page-content-bottom-inner" class="<?php echo esc_attr( mildhill_core_get_content_bottom_area_classes() ); ?>">

	<?php
	$custom_sidebar = mildhill_core_get_post_value_through_levels( 'qodef_content_bottom_custom_sidebar' );
	dynamic_sidebar( $custom_sidebar );
	?>

</div>