<div class="qodef-m-social-icons-group">
    <?php
    if ( ! empty( $icon_params ) ) {
         foreach ($icon_params as $icon_param) {
             echo MildhillCoreIconShortcode::call_shortcode($icon_param);
         }
     }
    ?>
</div>