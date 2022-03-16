<?php if ( ! empty( $text ) ) { ?>
    <p class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>><?php echo wp_kses( $text, array( 'br' => array() ) ); ?></p>
<?php } ?>