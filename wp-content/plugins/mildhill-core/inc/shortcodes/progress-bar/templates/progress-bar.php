<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
    <div class="qodef-m-inner">

		<?php if ( isset( $layout ) && 'line' === $layout ): ?>
			<?php if ( ! empty( $title ) ) : ?>
				<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
				<?php echo '</' . esc_attr( $title_tag ); ?>>
			<?php endif; ?>
		<?php endif; ?>

        <div class="qodef-m-media">
            <div class="qodef-m-canvas" id="qodef-m-canvas-<?php echo esc_attr( $rand_number ); ?>"></div>

			<?php if ( ! empty( $image ) ): ?>
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			<?php endif; ?>

        </div>

		<?php if ( isset( $layout ) && ( 'circle' === $layout || 'semi-circle' === $layout ) ): ?>
			<?php if ( ! empty( $title ) ) : ?>
				<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
				<?php echo '</' . esc_attr( $title_tag ); ?>>
			<?php endif; ?>
			<?php if ( ! empty( $text ) ) : ?>
                <p class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

    </div>
</div>