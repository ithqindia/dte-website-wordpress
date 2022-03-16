<div id="qodef-subscribe-popup-modal" class="qodef-sp-holder <?php echo esc_attr( $holder_classes ); ?>">
    <div class="qodef-sp-overlay-cover"></div>
    <div class="qodef-sp-inner">
        <a id="qodef-sp-close" class="qodef-opener-widget qodef-opener-widget--predefined" href="javascript:void(0)">
			<?php echo mildhill_core_get_svg( 'close' ); ?>
        </a>
        <div class="qodef-sp-content-container" <?php qode_framework_inline_style( $content_style ); ?>>

			<?php if ( ! empty( $title ) ) : ?>
                <h2 class="qodef-sp-title">
					<?php echo esc_html( $title ); ?>
                </h2>
			<?php endif; ?>
			<?php if ( ! empty( $subtitle ) ): ?>
                <div class="qodef-sp-subtitle">
					<?php echo esc_html( $subtitle ); ?>
                </div>
			<?php endif; ?>

			<?php echo do_shortcode( '[contact-form-7 id="' . $contact_form . '"]' ); ?>

			<?php if ( $enable_prevent === 'yes' ) : ?>
                <div class="qodef-sp-prevent">
                    <div class="qodef-sp-prevent-inner">
                        <span class="qodef-sp-prevent-input" data-value="no"></span>
                        <label class="qodef-sp-prevent-label"><?php esc_html_e( 'Prevent This Pop-up', 'mildhill-core' ); ?></label>
                    </div>
                </div>
			<?php endif; ?>

        </div>
    </div>
</div>
