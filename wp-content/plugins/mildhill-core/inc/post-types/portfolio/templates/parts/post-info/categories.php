<?php
	$categories   = wp_get_post_terms( get_the_ID(), 'portfolio-category' );
	if( is_array( $categories ) && count( $categories ) ) { ?>
		<div class="qodef-e qodef-portofolio-categories">
			<h5>
				<?php esc_html_e( 'Category: ', 'mildhill-core' ); ?>
			</h5>
			<?php foreach($categories as $cat) { ?>
				<a itemprop="url" class="qodef-portfolio-category" href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>">
					<?php echo esc_html($cat->name); ?>
				</a>
			<?php } ?>
		</div>
<?php }
