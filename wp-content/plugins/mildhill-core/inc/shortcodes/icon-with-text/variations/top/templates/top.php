<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<div class="qodef-m-icon-wrapper">
		<?php mildhill_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/' . $icon_type, '', $params ) ?>
	</div>
	<div class="qodef-m-content">
		<?php mildhill_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/title', '', $params ) ?>
		<?php mildhill_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/text', '', $params ) ?>
	</div>
</div>