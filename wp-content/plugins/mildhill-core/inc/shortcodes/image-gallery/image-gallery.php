<?php

if ( ! function_exists( 'mildhill_core_add_image_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function mildhill_core_add_image_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'MildhillCoreImageGalleryShortcode';

		return $shortcodes;
	}

	add_filter( 'mildhill_core_filter_register_shortcodes', 'mildhill_core_add_image_gallery_shortcode' );
}

if ( class_exists( 'MildhillCoreListShortcode' ) ) {
	class MildhillCoreImageGalleryShortcode extends MildhillCoreListShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( MILDHILL_CORE_SHORTCODES_URL_PATH . '/image-gallery' );
			$this->set_base( 'mildhill_core_image_gallery' );
			$this->set_name( esc_html__( 'Image Gallery', 'mildhill-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image gallery element', 'mildhill-core' ) );
			$this->set_category( esc_html__( 'Mildhill Core', 'mildhill-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'images',
				'multiple'   => 'yes',
				'title'      => esc_html__( 'Images', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'mildhill-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'image_action',
				'title'      => esc_html__( 'Image Action', 'mildhill-core' ),
				'options'    => array(
					''            => esc_html__( 'No Action', 'mildhill-core' ),
					'open-popup'  => esc_html__( 'Open Popup', 'mildhill-core' ),
					'custom-link' => esc_html__( 'Custom Link', 'mildhill-core' )
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'mildhill-core' ),
				'options'       => mildhill_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency'    => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->map_list_options( array(
				'exclude_option' => array( 'images_proportion' ),
				'group'          => esc_html__( 'Gallery Settings', 'mildhill-core' )
			) );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['images']         = $this->generate_images_params( $atts );
			$atts['data_attr']      = $this->get_justified_data( $atts );

			return mildhill_core_get_template_part( 'shortcodes/image-gallery', 'templates/image-gallery', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-gallery';
			$holder_classes[] = ! empty( $atts['image_action'] ) && $atts['image_action'] == 'open-popup' ? 'qodef-magnific-popup qodef-popup-gallery' : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-image-wrapper';

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		private function generate_images_params( $atts ) {
			$image_ids = array();
			$images    = array();
			$i         = 0;

			if ( $atts['images'] !== '' ) {
				$image_ids = explode( ',', $atts['images'] );
			}

			$image_size = $this->generate_image_size( $atts );

			foreach ( $image_ids as $id ) {
				$image['image_id']   = intval( $id );
				$image_original      = wp_get_attachment_image_src( $id, 'full' );
				$image['url']        = $this->generate_image_url( $id, $atts, $image_original[0] );
				$image['alt']        = get_post_meta( $id, '_wp_attachment_image_alt', true );
				$image['image_size'] = $image_size;

				$images[ $i ] = $image;
				$i ++;
			}

			return $images;
		}

		private function generate_image_size( $atts ) {
			$image_size = trim( $atts['image_size'] );
			preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
			if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
				return $image_size;
			} elseif ( ! empty( $matches[0] ) ) {
				return array(
					$matches[0][0],
					$matches[0][1]
				);
			} else {
				return 'full';
			}
		}

		private function generate_image_url( $id, $atts, $default ) {
			if ( $atts['image_action'] == 'custom-link' ) {
				$url = get_post_meta( $id, 'qodef_image_custom_link', true );
				if ( empty( $url ) ) {
					$url = $default;
				}
			} else {
				$url = $default;
			}

			return $url;
		}

		private function get_justified_data( $atts ) {
			$data = array();

			if ( 'justified-gallery' === $atts['behavior'] ) {
				$data['justified_gallery_row_height']     = ! empty( $atts['justified_gallery_row_height'] ) ? intval( $atts['justified_gallery_row_height'] ) : '150';
				$data['justified_gallery_row_height_max'] = ! empty( $atts['justified_gallery_row_height_max'] ) ? intval( $atts['justified_gallery_row_height_max'] ) : 'false';
				$data['justified_gallery_treshold']       = ! empty( $atts['justified_gallery_treshold'] ) ? intval( $atts['justified_gallery_treshold'] ) : '0.75';
				$data['space_value']                      = ! empty( $atts['space'] ) ? mildhill_core_get_space_value( $atts['space'] ) : '15';
			}

			return json_encode( $data );
		}
	}
}