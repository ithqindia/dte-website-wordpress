<?php if ( is_active_sidebar( 'qodef-side-area' ) ) { ?>
    <div id="qodef-side-area" <?php qode_framework_class_attribute( $classes ); ?>>
        <a id="qodef-side-area-close" class="qodef-opener-widget <?php echo mildhill_core_get_open_close_icon_class( 'qodef_side_area_icon_source', 'qodef-opener-widget' ); ?>" href="javascript:void(0)">
            <span class="qodef-m-icon">
    			<?php echo mildhill_core_get_side_area_icon_html( true ); ?>
            </span>
        </a>
        <div id="qodef-side-area-inner">
			<?php dynamic_sidebar( 'qodef-side-area' ); ?>
        </div>
    </div>
<?php } ?>