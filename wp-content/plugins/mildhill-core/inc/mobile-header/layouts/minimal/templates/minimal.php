<a href="javascript:void(0)"
   class="qodef-fullscreen-menu-opener qodef-opener-widget qodef-opener-widget--predefined qodef-mobile-menu-opener <?php echo mildhill_core_get_open_close_icon_class( 'qodef_fullscreen_menu_icon_source', 'qodef-fullscreen-menu-opener' ) ?>">
	<span class="qodef-m-icon qodef-m-open-icon">
		<?php echo mildhill_core_get_fullscreen_icon_html(); ?>
	</span>
    <span class="qodef-m-icon qodef-m-close-icon">
		<?php echo mildhill_core_get_fullscreen_icon_html( true );
		?>
	</span>
</a>

<?php
// Include mobile logo
mildhill_core_get_mobile_header_logo_image();
?>
<div class="qodef-widget-holder">
	<?php
	// Include mobile haeder widget area
	dynamic_sidebar( 'qodef-mobile-header-widget-area' );

	// Include mobile navigation opener
	//mildhill_core_template_part( 'mobile-header', 'templates/parts/mobile-navigation-opener' );
	?>
</div>

