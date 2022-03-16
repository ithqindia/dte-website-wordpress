<div class="qodef-header-sticky">
    <div class="qodef-header-sticky-inner <?php echo apply_filters( 'mildhill_filter_header_inner_class', '' ); ?>">
        <?php
        mildhill_core_get_header_logo_image('sticky');
        mildhill_core_template_part( 'header', 'templates/parts/navigation', '', array( 'menu_id' => 'qodef-sticky-navigation-menu' ) );
        ?>
        <div class="qodef-widget-holder">
            <?php mildhill_core_get_header_widget_area( 'sticky' ); ?>
        </div>

        <?php do_action('mildhill_core_action_after_sticky_header'); ?>
    </div>
</div>