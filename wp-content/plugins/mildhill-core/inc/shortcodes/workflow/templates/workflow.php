<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php

	foreach ( $items

	as $key => $item ):
	$item['number'] = $key;
	$additional     = $this_object->getItemAdditional( $item );
	$item_classes   = $additional['classes'];
	$circle_styles  = $additional['circle_styles'];
	$image_styles   = $additional['image_styles'];

	?>

    <div class="qodef-m-workflow-item">
        <div class="qodef-m-workflow-item-inner" <?php echo qode_framework_get_inline_style( $inner_styles ); ?>>

			<?php if ( ! empty( $item['image_background_color'] ) ): ?>

            <div <?php qode_framework_class_attribute( $item_classes ) ?>>
            <div class="qodef-m-workflow-image-inner" <?php echo qode_framework_get_inline_style( $image_styles ); ?>>
				<?php echo wp_get_attachment_image( $item['image'], array( 200, 200 ) ) ?>
            </div>
        </div>

		<?php else: ?>

        <div <?php qode_framework_class_attribute( $item_classes ) ?>>
        <div class="qodef-m-workflow-image-inner">
			<?php echo wp_get_attachment_image( $item['image'], array( 200, 200 ) ) ?>
        </div>
    </div>

<?php endif; ?>

    <div class="qodef-m-workflow-text">
        <span class="qodef-m-circle" <?php echo qode_framework_get_inline_style( $circle_styles ); ?>></span>
        <var class="qodef-m-text"><?php echo wp_kses( nl2br( $item['text'] ), array( 'br' => array() ) ) ?></var>
        <h4 class="qodef-m-title"><?php echo esc_html( $item['title'] ); ?></h4>
    </div>

</div>
</div>

<?php endforeach; ?>

</div>