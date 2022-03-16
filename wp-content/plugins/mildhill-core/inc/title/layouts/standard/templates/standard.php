<?php
// Load title image template
mildhill_core_get_page_title_image();
$title_tag = mildhill_core_get_page_title_tag();
?>

<div class="qodef-m-content <?php echo esc_attr( mildhill_core_get_page_title_content_classes() ); ?>">
    <<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title entry-title">
        <?php if ( qode_framework_is_installed( 'theme' ) ) {
            echo esc_html( mildhill_get_page_title_text() );
        } else {
            echo get_option( 'blogname' );
        } ?>
    </<?php echo esc_attr( $title_tag ); ?>>
    <?php
    // Load subtitle template
    mildhill_core_template_part( 'title/layouts/standard', 'templates/parts/subtitle', '', mildhill_core_get_standard_title_layout_subtitle_text() );
    ?>
</div>