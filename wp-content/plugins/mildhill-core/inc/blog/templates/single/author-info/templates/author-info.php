<?php
$is_enabled = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_enable_author_info' );

if ( $is_enabled === 'yes' && get_the_author_meta( 'description' ) !== '' ) {
	$author_link   = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$email_enabled = mildhill_core_get_post_value_through_levels( 'qodef_blog_single_enable_author_info_email' ) === 'yes';
	$user_socials  = mildhill_core_get_author_social_networks();
	?>
    <div id="qodef-author-info" class="qodef-m">
        <div class="qodef-m-inner">
            <div class="qodef-m-image">
                <a itemprop="url" href="<?php echo esc_url( $author_link ); ?>" title="<?php the_title_attribute(); ?>">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 168 ); ?>
                </a>
            </div>
            <div class="qodef-m-content">
                <h5 class="qodef-m-author vcard author">
                    <a itemprop="url" href="<?php echo esc_url( $author_link ); ?>" title="<?php the_title_attribute(); ?>">
                        <span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
                    </a>
                </h5>
				<?php if ( $email_enabled && is_email( get_the_author_meta( 'email' ) ) ) { ?>
                    <p itemprop="email" class="qodef-m-email"><?php echo sanitize_email( get_the_author_meta( 'email' ) ); ?></p>
				<?php } ?>
                <p itemprop="description" class="qodef-m-description"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
				<?php if ( ! empty( $user_socials ) ) { ?>
                    <div class="qodef-m-social-icons">
                        <ul>
							<?php foreach ( $user_socials as $social ) { ?>
                                <li>
                                    <a itemprop="url" class="<?php echo esc_attr( $social['class'] ) ?>" href="<?php echo esc_url( $social['url'] ) ?>" target="_blank">
										<?php echo qode_framework_icons()->render_icon( $social['icon'], 'elegant-icons' ); ?>
                                    </a>
                                </li>
							<?php } ?>
                        </ul>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
<?php } ?>