<?php mildhill_core_get_header_logo_image(); ?>
<div class="qodef-widget-holder">
	<?php mildhill_core_get_header_widget_area(); ?>
</div>
<a href="javascript:void(0)" class="qodef-fullscreen-menu-opener qodef-opener-widget <?php echo mildhill_core_get_open_close_icon_class( 'qodef_fullscreen_menu_icon_source', 'qodef-opener-widget' ); ?>">

    <span class="qodef-m-icon qodef-m-open-icon">
        <?php echo mildhill_core_get_fullscreen_icon_html(); ?>
    </span>

    <span class="qodef-m-icon qodef-m-close-icon">
		<?php echo mildhill_core_get_fullscreen_icon_html( true ); ?>
	</span>

</a>