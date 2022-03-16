<?php if ( class_exists( 'MildhillCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'mildhill-core' );
		
		echo MildhillCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>