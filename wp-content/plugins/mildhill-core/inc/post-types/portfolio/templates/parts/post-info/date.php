<div class="qodef-e qodef-portfolio-date">
	<h5>
		<?php esc_html_e( 'Date: ', 'mildhill-core' ); ?>
	</h5>
	<p itemprop="dateCreated" class="entry-date updated">
		<?php the_time(get_option('date_format')); ?>
	</p>
	<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number( get_the_ID() ); ?>"/>
</div>
