<?php if ( $show_top_area ) { ?>
    <div id="qodef-top-area">
        <div id="qodef-top-area-inner" class="<?php echo esc_attr( mildhill_core_get_top_area_classes() ); ?>">
            <div class="qodef-top-area-left">
				<?php mildhill_core_get_header_widget_area( 'top-area-left' ); ?>
            </div>
            <div class="qodef-top-area-right">
				<?php mildhill_core_get_header_widget_area( 'top-area-right' ); ?>
            </div>
			<?php do_action( 'mildhill_core_action_after_top_area' ); ?>
        </div>
    </div>
<?php } ?>