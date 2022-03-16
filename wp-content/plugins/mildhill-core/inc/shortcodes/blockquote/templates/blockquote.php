<div <?php qode_framework_class_attribute( $holder_classes ) ?>>
	<div class="qodef-m-outer">
		<div class="qodef-m-inner" <?php qode_framework_inline_style( $content_styles ); ?>>
			<?php if ( ! empty( $text ) ) { ?>
				<var class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>>
					<?php echo esc_html( $text ); ?>
				</var>
			<?php } ?>

		</div>
	</div>
</div>

