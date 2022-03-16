<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>

	<?php if ( ! empty( $link ) ) : ?>
        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>

    <?php if (!empty($main_icon)): ?>
        <?php mildhill_core_template_part( 'shortcodes/icon-list-item', 'templates/parts/icon-pack', '', $params ) ?>
    <?php endif; ?>

	<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
		<?php echo esc_html( $title ); ?>
	<?php echo '</' . esc_attr( $title_tag ); ?>>

	<?php if ( ! empty( $text ) ) : ?>
		<?php echo '<' . esc_attr( $text_tag ); ?> class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>>
        <?php echo wp_kses( $text, array( 'br' => array() ) ) ?>
		<?php echo '</' . esc_attr( $text_tag ); ?>>
	<?php endif; ?>

    <?php if ( ! empty( $link ) ) : ?>
        </a>
    <?php endif; ?>

</div>