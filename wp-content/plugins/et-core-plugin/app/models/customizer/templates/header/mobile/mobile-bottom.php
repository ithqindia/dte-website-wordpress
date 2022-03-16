<?php
/**
 * The template for displaying theme mobile-bottom
 *
 * @since   1.4.1
 * @version 1.0.0
 * last changes in 1.5.5
 */
 ?>

<?php
	$data = json_decode( Kirki::get_option( 'header_mobile_bottom_elements' ), true );

	if ( ! is_array( $data ) ) {
		$data = array();
	}

    uasort( $data, function ( $item1, $item2 ) {
	    return $item1['index'] <=> $item2['index'];
	});

	if ( count($data) < 1 && !is_customize_preview() ) return;

	$header_options = array();
	$header_options['class'] = Kirki::get_option( 'bottom_header_sticky_et-mobile' ) ? 'sticky' : '';

?>

<div class="header-bottom-wrapper <?php echo esc_attr($header_options['class']); ?>">
	<div class="header-bottom" data-title="<?php esc_html_e( 'Header bottom', 'xstore-core' ); ?>">
		<div class="et-row-container<?php echo !(Kirki::get_option( 'bottom_header_wide_et-mobile' )) ? ' et-container' : ''; ?>">
			<div class="et-wrap-columns flex align-items-center"><?php echo mobile_header_bottom_callback(); ?></div><?php // to prevent empty spaces in DOM content ?>
		</div>
	</div>
</div>