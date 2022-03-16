<div class="qodef-e qodef-portfolio-social-share">
	<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'mildhill-core' );
		$params['layout'] = 'list';
		echo MildhillCoreSocialShareShortcode::call_shortcode( $params );
	?>
</div>