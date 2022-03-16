<?php

if ( ! function_exists( 'mildhill_core_social_networks_list' ) ) {
	/**
	 * Function that returns array of social networks.
	 *
	 * @return array - list of social networks
	 */
	function mildhill_core_social_networks_list() {
		$social_networks = array(
			'facebook'  => array(
				'label'   => esc_html__( 'Facebook', 'mildhill-core' ),
				'shorten' => esc_html__( 'fb', 'mildhill-core' )
			),
			'twitter'   => array(
				'label'   => esc_html__( 'Twitter', 'mildhill-core' ),
				'shorten' => esc_html__( 'tw', 'mildhill-core' )
			),
			'linkedin'  => array(
				'label'   => esc_html__( 'LinkedIn', 'mildhill-core' ),
				'shorten' => esc_html__( 'lnkd', 'mildhill-core' )
			),
			'pinterest' => array(
				'label'   => esc_html__( 'Pinterest', 'mildhill-core' ),
				'shorten' => esc_html__( 'pin', 'mildhill-core' )
			),
			'tumblr'    => array(
				'label'   => esc_html__( 'Tumblr', 'mildhill-core' ),
				'shorten' => esc_html__( 'tmb', 'mildhill-core' )
			),
			'vk'        => array(
				'label'   => esc_html__( 'VK', 'mildhill-core' ),
				'shorten' => esc_html__( 'vk', 'mildhill-core' )
			)
		);

		return apply_filters( 'mildhill_core_filter_social_networks_list', $social_networks );
	}
}

if ( ! function_exists( 'mildhill_core_enabled_social_networks_list' ) ) {
	/**
	 * Function that returns array of social networks.
	 *
	 * @return array - list of social networks
	 */
	function mildhill_core_enabled_social_networks_list() {
		$social_networks = mildhill_core_social_networks_list();

		foreach ( $social_networks as $network => $label ) {
			$network_enabled = mildhill_core_get_option_value( 'admin', 'qodef_enable_share_' . $network ) == 'yes' ? true : false;

			if ( ! $network_enabled ) {
				unset( $social_networks[ $network ] );
			}
		}

		return $social_networks;
	}
}

if ( ! function_exists( 'mildhill_core_get_social_network_share_link' ) ) {
	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 *
	 * @return string
	 */
	function mildhill_core_get_social_network_share_link( $net, $image ) {
		switch ( $net ) {
			case 'facebook':
				if ( wp_is_mobile() ) {
					$link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\');';
				} else {
					$link = 'window.open(\'https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char             = ( isset( $_SERVER['https'] ) ) ? 23 : 22;
				$twitter_via_option_val = mildhill_core_get_option_value( 'admin', 'qodef_twitter_via' );
				$twitter_via            = ( $twitter_via_option_val !== '' ) ? ' via ' . $twitter_via_option_val . ' ' : '';
				$link =  'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( mildhill_core_get_social_network_excerpt_max_charlength( $count_char ) . $twitter_via ) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';

				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'https://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'https://www.tumblr.com/share/link?url=' . urlencode( get_permalink() ) . '&amp;name=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
				$link = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( get_the_title() ) . '&amp;media=' . urlencode( $image[0] ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$link = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '&amp;image=' . urlencode( $image[0] ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}

		return apply_filters( 'mildhill_core_filter_social_network_share_linl', $link, $net, $image );
	}
}

if ( ! function_exists( 'mildhill_core_get_social_network_excerpt_max_charlength' ) ) {
	function mildhill_core_get_social_network_excerpt_max_charlength( $charlength ) {
		$twitter_via_meta = mildhill_core_get_option_value( 'admin', 'qodef_twitter_via' );
		$via              = ! empty( $twitter_via_meta ) ? esc_attr__( ' via ', 'mildhill-core' ) . esc_attr( $twitter_via_meta ) : '';

		$excerpt_text = get_the_excerpt();
		$excerpt      = esc_html( strip_shortcodes( $excerpt_text ) );
		$charlength   = 139 - ( mb_strlen( $via ) + $charlength );

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex   = mb_substr( $excerpt, 0, $charlength );
			$exwords = explode( ' ', $subex );
			$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}