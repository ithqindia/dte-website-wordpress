<?php 
use ETC\App\Traits\Elementor;

$advancedtabnonce = wp_create_nonce( 'etheme_advancedtabnonce' ); 
$settings['hide_buttons'] = ( 'yes' == $settings['hide_buttons'] ) ? '' : 'yes';?> 
<div <?php echo $et_tab_wrapper; ?>>
	<div class="et-tabs-nav">
		<ul <?php echo $et_tab_ul; ?> data-wid="<?php echo esc_attr( $_wid ); ?>"  data-nonce="<?php echo $advancedtabnonce; ?>">
			<?php 
			$count = 0;
			if ( in_array( 'active-default', array_column( $settings['et_tabs_tab'], 'et_tabs_tab_show_as_default' ) ) ) {
				$default_tab = true;
			}

			foreach ( $settings['et_tabs_tab'] as $tab ):
				$tab['navigation_position_style'] =	$settings['navigation_position_style'];
				$tab['navigation_position'] 	  =	$settings['navigation_position'];
				$tab['navigation_style'] 	  	  =	$settings['navigation_style'];
	            $tab['hide_buttons_for']          = $settings['hide_buttons_for'];
	            $tab['hide_buttons']              = $settings['hide_buttons'];
				$tab['product_view']              = $settings['product_view'];
				$tab['product_view_color']        = $settings['product_view_color'];
				$tab['product_img_hover']         = $settings['product_img_hover'];
				// Pagination
				$tab['pagination_type']         = $settings['pagination_type'];
				$tab['hide_fo']         		= $settings['hide_fo'];
				$tab['default_color']         	= $settings['default_color'];
				$tab['active_color']         	= $settings['active_color'];
				// Slider settings
				$tab['slider_autoplay']         = $settings['slider_autoplay'];
				$tab['slider_stop_on_hover']    = $settings['slider_stop_on_hover'];
				$tab['slider_interval']         = $settings['slider_interval'];
				$tab['slider_loop']         	= $settings['slider_loop'];
				$tab['slider_speed']         	= $settings['slider_speed'];
				$tab['slides']         			= $settings['slides'];
				// style of slider
				$tab['style']         			= $settings['style'];
				$tab['no_spacing']          	= $settings['no_spacing'];
				$tab['per_iteration']       	= $settings['per_iteration'];
				$tab['ajax']         			= $settings['ajax'];
				$tab['navigation_nav_position'] = $settings['navigation_nav_position'];

			if( 'nav-bar' === $settings['navigation_position'] ):

				$visibility = 'none';

				if( isset( $default_tab ) && 'active-default' == $tab['et_tabs_tab_show_as_default'] ){
					$visibility = 'flex';
				} elseif( !isset( $default_tab ) && '' != $tab['et_tabs_tab_show_as_default'] && 0 === $count ) {
					$visibility = 'flex';
				}

				$count++;

				$slider = Elementor::slider_navigation( $settings, $tab, $visibility );
				echo $slider; 
			?>
			<?php endif; ?>

			<?php if( '' != $tab['et_tabs_content_title'] ): ?>
				<li data-id="<?php echo esc_attr( $tab['_id'] ); ?>" class="skip et-content-title" style="visibility:hidden; display: none;">
					<span>
						<?php echo $tab['et_tabs_content_title']; ?>
					</span>
				</li>
			<?php endif; ?>
			<li data-json="<?php echo esc_attr( wp_json_encode( $tab ) ); ?>" data-id="<?php echo esc_attr( $tab['_id'] ); ?>" class="<?php echo esc_attr($tab['et_tabs_tab_show_as_default']); ?> et-tab-nav">
				<?php if ( 'yes' === $settings['et_tabs_icon_show_horizontal'] ): ?>
					<?php if ( $tab['et_tabs_icon_type'] === 'icon' ): ?>
						<?php echo '<i class="' . $tab['et_tabs_tab_title_icon']['value'] . '"></i>'; ?>
						<?php elseif ( $tab['et_tabs_icon_type'] === 'image' ): ?>
							<img src="<?php echo esc_attr( $tab['et_tabs_tab_title_image']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $tab['et_tabs_tab_title_image']['id'], '_wp_attachment_image_alt', true ) ); ?>">
					<?php endif;?>
				<?php endif;?>
				<?php if( 'horizontal-style-6' != $settings['et_tab_horizontal_style'] ): ?>
					<span class="et-tab-title">
						<?php echo $tab['et_tabs_tab_title']; ?>
					</span>
				<?php endif; ?>
            </li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="et-tabs-content">
		<?php $count = 0;
		if ( in_array( 'active-default', array_column($settings['et_tabs_tab'], 'et_tabs_tab_show_as_default' ) ) ) {
			$skip = true;
		}

		foreach ( $settings['et_tabs_tab'] as $tabs ):

			if ( isset( $skip ) && 'active-default' !== $tabs['et_tabs_tab_show_as_default'] ) {
				continue;
			}

			if ( ! isset( $skip ) && 0 < $count ) {
				continue;
			}

			$count++;

			$atts = array();
			?>
			<div data-id="<?php echo esc_attr( $tabs['_id'] ); ?>" class="clearfix <?php echo esc_attr($tabs['et_tabs_tab_show_as_default']);?> <?php echo esc_attr( $settings['navigation_position_style'] );?> <?php echo ( 'middle-inside' === $settings['navigation_position'] ) ? esc_attr( 'middle-inside' ): ''; ?>">
                <?php
                foreach ( $tabs as $key => $tab ):

                    if ( $tab ) {
                        switch ( $key ) {
                            case 'ids':
                            case 'taxonomies':
                            $atts[$key] = !empty( $tab ) ? implode( ',',$tab ) : array();
                            break;
                            case 'slides':
                            $atts['large'] = $atts['notebook'] = $tab;
                            break;
                            case 'slides_tablet':
                            $atts['tablet_land'] = $atts['tablet_portrait'] = $tab;
                            break;
                            case 'slides_mobile':
                            $atts['mobile'] = $tab;
                            break;

                            default:
                            $atts[$key] = $tab;
                            break;
                        }
                        // General style
                        $atts['navigation_position_style'] 	=	$settings['navigation_position_style'];
                        $atts['navigation_position'] 	  	=	$settings['navigation_position'];
                        $atts['navigation_style'] 	  	  	=	$settings['navigation_style'];
			            $atts['hide_buttons_for']           =   $settings['hide_buttons_for'];
			            $atts['hide_buttons']               =   $settings['hide_buttons'];
			            $atts['product_view']               =   $settings['product_view'];
			            $atts['product_view_color']         =   $settings['product_view_color'];
			            $atts['product_img_hover']          =   $settings['product_img_hover'];
			            // Pagination
			            $atts['pagination_type']        = $settings['pagination_type'];
			            $atts['hide_fo']         		= $settings['hide_fo'];
			            $atts['default_color']         	= $settings['default_color'];
			            $atts['active_color']         	= $settings['active_color'];
						// Slider settings
						$atts['slider_autoplay']        = $settings['slider_autoplay'];
						$atts['slider_stop_on_hover']   = $settings['slider_stop_on_hover'];
						$atts['slider_interval']        = $settings['slider_interval'];
						$atts['slider_loop']         	= $settings['slider_loop'];
						$atts['slider_speed']         	= $settings['slider_speed'];
						$atts['slides']         		= $settings['slides'];
						// Style 
						$atts['style']         		= $settings['style'];
						$atts['no_spacing']         = $settings['no_spacing'];
						$atts['per_iteration']      = $settings['per_iteration'];
						$atts['ajax']         		= $settings['ajax'];
                    }

                endforeach;

                $atts['is_preview'] = $is_preview;
                $atts['elementor']  = true;
                echo $Products_Shortcode->products_shortcode( $atts, '' );
            ?>
            </div>
        <?php endforeach; ?>
        <?php etheme_loader( true, 'product-ajax' ); ?>
	</div>
</div>
