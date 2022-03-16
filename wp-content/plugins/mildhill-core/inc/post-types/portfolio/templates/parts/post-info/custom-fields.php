<?php
$portfolio_info_items = get_post_meta( get_the_ID(), 'qodef_portfolio_info_items', true );
if( ! empty ($portfolio_info_items ) ) { ?>

		<?php foreach ($portfolio_info_items as $item ) {
			$label  = $item['qodef_info_item_label'];
			$value  = $item['qodef_info_item_value'];
			$link   = ! empty( $item['qodef_info_item_link'] ) ? $item['qodef_info_item_link'] : '_blank';
			$target = $item['qodef_info_item_target'];

            ?><div class="qodef-e qodef-portfolio-info-item"><?php
                if( ! empty ( $label ) ) { ?>
                    <h5><?php echo esc_html( $label ); ?>: </h5>
                <?php }
                if( ! empty ( $link ) ) { ?>
                    <a class="qodef-portfolio-info-item" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
                <?php } else { ?>
                    <span class="qodef-portfolio-info-item">
                <?php } ?>
                    <?php echo esc_html( $value ); ?>
                <?php if( empty ( $link ) ) { ?>
                    </span>
                <?php } else { ?>
                    </a>
                <?php } ?>
			</div>
		<?php } ?>

<?php }
