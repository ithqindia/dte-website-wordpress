<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

// Add new input type "box_shadow".
if ( function_exists( 'smile_add_input_type' ) ) {
	smile_add_input_type( 'box_shadow', 'box_shadow_settings_field' );
}

add_action( 'admin_enqueue_scripts', 'enqueue_box_shadow_param_scripts' );
/**
 * Function Name:enqueue_box_shadow_param_scripts description.
 *
 * @param  array $hook ap page list.
 */
function enqueue_box_shadow_param_scripts( $hook ) {
	if ( isset( $_REQUEST['cp_admin_page_nonce'] ) && wp_verify_nonce( $_REQUEST['cp_admin_page_nonce'], 'cp_admin_page' ) ) {
		$cp_page = strpos( $hook, CP_PLUS_SLUG );
		$data    = get_option( 'convert_plug_debug' );

		if ( false !== $cp_page && isset( $_GET['style-view'] ) && ( 'edit' === $_GET['style-view'] || 'variant' === $_GET['style-view'] ) ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );

			wp_enqueue_style( 'jquery-ui' );
			wp_enqueue_script( 'convert-plus-box_shadow', SMILE_FRAMEWORK_URI . '/lib/fields/box-shadow/js/boxShadow.js', array( 'jquery' ), CP_VERSION, false );
			if ( isset( $data['cp-dev-mode'] ) && '1' === $data['cp-dev-mode'] ) {
				wp_enqueue_style( 'convert-plus-box_shadow-layout', SMILE_FRAMEWORK_URI . '/lib/fields/box-shadow/css/layout.css', array(), CP_VERSION );
			}
		}
	}
}

/**
 * Function Name:box_shadow_settings_field Function to handle new input type "box_shadow".
 *
 * @param  string $name     settings provided when using the input type "box_shadow".
 * @param  string $settings holds the default / updated value.
 * @param  string $value    html output generated by the function.
 * @return string           html output generated by the function.
 */
function box_shadow_settings_field( $name, $settings, $value ) {
	$input_name = $name;
	$type       = isset( $settings['type'] ) ? $settings['type'] : '';
	$class      = isset( $settings['class'] ) ? $settings['class'] : '';

	// Apply partials.
	$partials = generate_partial_atts( $settings );

	$output = '<p><textarea id="box-shadow-code" class="content form-control smile-input smile-' . $type . ' ' . $input_name . ' ' . $type . ' ' . $class . '" name="' . $input_name . '" rows="6" cols="6" ' . $partials . ' >' . $value . '</textarea></p>';

	$pairs    = explode( '|', $value );
	$settings = array();
	if ( is_array( $pairs ) && ! empty( $pairs ) && count( $pairs ) > 1 ) {
		foreach ( $pairs as $pair ) {
			$values                 = explode( ':', $pair );
			$settings[ $values[0] ] = $values[1];
		}
	}

	ob_start();
	echo wp_kses_post( $output );

	$type                      = isset( $settings['type'] ) ? $settings['type'] : 'none';
	$horizontal                = isset( $settings['horizontal'] ) ? $settings['horizontal'] : 0;
	$vertical                  = isset( $settings['vertical'] ) ? $settings['vertical'] : 0;
	$blur                      = isset( $settings['blur'] ) ? $settings['blur'] : 0;
	$spread                    = isset( $settings['spread'] ) ? $settings['spread'] : 0;
	$color                     = isset( $settings['color'] ) ? $settings['color'] : 'rgba(0, 0, 0, 0.5)';
	$smile_shadow_hide_options = '';

	if ( 'none' === $type ) {
		$smile_shadow_hide_options = 'smile-shadow-hidden';
	}

	?>
	<div class="box">
		<div class="holder">
			<div class="frame">
				<div class="setting-block">
					<div class="option-panel"> <strong><?php esc_html_e( 'Type', 'smile' ); ?></strong></span>
						<div class="switch-wrapper shadow_type">
							<?php
							$shadow_type = '';
							$options     = array(
								'None'   => 'none',
								'Outset' => 'outset',
								'Inset'  => 'inset',
							);

							?>
							<p><select name="shadow_type" id="smile_shadow_type" class="form-control smile-input smile-select shadow_type">
								<?php
								foreach ( $options as $text_val => $val ) {
									?>
									<option class="smile_<?php echo esc_attr( $val ); ?>" <?php esc_attr( selected( $val, $type, true ) ); ?> value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( htmlspecialchars( $text_val, ENT_QUOTES, 'utf-8' ) ); ?></option>
									<?php } ?>
								</select></p>
							</div>
						</div>
					</div>
					<div class="smile-shadow-options <?php echo esc_attr( $smile_shadow_hide_options ); ?>">
						<div class="setting-block">
							<div class="row color-row">
								<label for="shadow-color"><strong><?php esc_html_e( 'Shadow Color', 'smile' ); ?></strong></label>
								<div class="text-2">
									<input id="shadow-color" class="cs-wp-color-picker " data-default-color="<?php echo esc_attr( $color ); ?>" type="text" value="<?php echo esc_attr( $color ); ?>">
								</div>
							</div>
						</div>
						<div class="setting-block">
							<div class="row">
								<label for="horizontal-length"><?php esc_html_e( 'Horizontal Length', 'smile' ); ?></label>
								<label class="align-right" for="horizontal-length">px</label>
								<div class="text-1">
									<input id="horizontal-length" class="sm-small-inputs" type="number" value="<?php echo esc_attr( $horizontal ); ?>">
								</div>
							</div>
							<div id="slider-horizontal-bs" class="slider-bar large ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><span class="range-quantity" ></span></div>
							<div class="row mtop15">
								<label for="vertical-length"><?php esc_html_e( 'Vertical Length', 'smile' ); ?></label>
								<label class="align-right" for="vertical-length">px</label>
								<div class="text-1">
									<input id="vertical-length" class="sm-small-inputs" type="number" value="<?php echo esc_attr( $vertical ); ?>">
								</div>
							</div>
							<div id="slider-vertical-bs" class="slider-bar large ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><span class="range-quantity" ></span></div>
						</div>
						<div class="setting-block">
							<div class="row">
								<label for="blur-radius"><?php esc_html_e( 'Blur Radius', 'smile' ); ?></label>
								<label class="align-right" for="blur-radius">px</label>
								<div class="text-1">
									<input id="blur-radius" class="sm-small-inputs" type="number" min="0" value="<?php echo esc_attr( $blur ); ?>">
								</div>
							</div>
							<div id="slider-blur-bs" class="slider-bar large ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><span class="range-quantity" ></span></div>
							<div class="row mtop15">
								<label for="spread-field"><?php esc_html_e( 'Spread Radius', 'smile' ); ?></label>
								<label class="align-right" for="spread-field">px</label>
								<div class="text-1">
									<input id="spread-field" class="sm-small-inputs" type="number" value="<?php echo esc_attr( $spread ); ?>">
								</div>
							</div>
							<div id="slider-spread-field" class="row-s slider-bar large ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><a class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><span class="range-quantity" ></span></div>
						</div> 
					</div>  
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();

}
