<div <?php qode_framework_class_attribute( $holder_classes ) ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
    <div class="qodef-m-outer">
        <div class="qodef-m-inner" <?php qode_framework_inline_style( $content_styles ); ?>>
			<?php if ( ! empty( $title ) ) { ?>
				<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
				<?php echo '</' . esc_attr( $title_tag ); ?>>
			<?php } ?>

			<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"]' ); ?>
        </div>
    </div>
</div>