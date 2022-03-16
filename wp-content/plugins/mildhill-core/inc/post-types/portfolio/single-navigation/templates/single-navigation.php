<?php
$is_enabled   = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );
$back_to_link = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_back_to_link' );

if ( $is_enabled === 'yes' ) {
	$through_same_category = mildhill_core_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' ) === 'yes';
	?>
    <div id="qodef-single-portfolio-navigation" class="qodef-m">
        <div class="qodef-m-inner">
			<?php

			$post_navigation = array(
				'prev' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Prev Project', 'mildhill-core' ) . '</span>',
					'icon'  => qode_framework_icons()->render_icon( 'arrow_carrot-left', 'elegant-icons' )
				),
				'next' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next Project', 'mildhill-core' ) . '</span>',
					'icon'  => qode_framework_icons()->render_icon( 'arrow_carrot-right', 'elegant-icons' )
				)
			);

			if ( $through_same_category ) {
				if ( get_adjacent_post( true, '', true, 'portfolio-category' ) !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post( true, '', true, 'portfolio-category' );
				}
				if ( get_adjacent_post( true, '', false, 'portfolio-category' ) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post( true, '', false, 'portfolio-category' );
				}
			} else {
				if ( get_adjacent_post( false, '', true ) !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post( false, '', true );
				}
				if ( get_adjacent_post( false, '', false ) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post( false, '', false );
				}
			}

			foreach ( $post_navigation as $key => $value ) {
				if ( isset( $post_navigation[ $key ]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = $current_post->ID;
					?>
                    <a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo get_permalink( $post_id ); ?>">
						<?php echo wp_kses( $value['icon'], array( 'span' => array( 'class' => true ) ) ); ?>
						<?php echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) ); ?>
                    </a>
				<?php }
			}

			if ( ! empty( $back_to_link ) ) { ?>
                <a itemprop="url" class="qodef-m-nav qodef--back-to-link" href="<?php echo get_permalink( $back_to_link ); ?>"><?php echo esc_html__( 'Portfolio List', 'mildhill-core' ); ?></a>
			<?php }
			?>
        </div>
    </div>
<?php } ?>