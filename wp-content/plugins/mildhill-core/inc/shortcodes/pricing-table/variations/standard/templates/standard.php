<?php
$style = array();
$svg = mildhill_core_get_svg('pricing-table', '#fff7e6');
$svg_featured = mildhill_core_get_svg('pricing-table', '#a6cef9' );
    if (isset($featured_table) && $featured_table ==='yes') {
        $svg_encoded = base64_encode($svg_featured);
    } else{
        $svg_encoded = base64_encode($svg);
    }
$style[] = 'background-image:url("data:image/svg+xml;base64,' . $svg_encoded . '")';
?>
<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-m-outer" <?php qode_framework_inline_style( $style );?>>
        <div class="qodef-m-inner">
            <?php mildhill_core_template_part( 'shortcodes/pricing-table', 'templates/parts/title', '', $params ) ?>
            <?php mildhill_core_template_part( 'shortcodes/pricing-table', 'templates/parts/price', '', $params ) ?>
            <?php mildhill_core_template_part( 'shortcodes/pricing-table', 'templates/parts/content', '', $params ) ?>
            <?php mildhill_core_template_part( 'shortcodes/pricing-table', 'templates/parts/button', '', $params ) ?>
        </div>
    </div>
</div>