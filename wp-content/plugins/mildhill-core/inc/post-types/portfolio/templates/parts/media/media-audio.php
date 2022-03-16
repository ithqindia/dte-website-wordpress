<?php
if( isset( $media ) && ! empty( $media ) ) {
	echo wp_audio_shortcode( array( 'src' => esc_url( $media ) ) );
}