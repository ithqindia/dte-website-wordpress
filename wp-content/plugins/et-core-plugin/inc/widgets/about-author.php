<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
// **********************************************************************// 
// ! About Author Widget
// **********************************************************************// 
class ETheme_About_Author_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_about_author', 'description' => esc_html__( "About author block", 'xstore-core') );
        parent::__construct('etheme-about-author', '8theme - '.esc_html__('About Author', 'xstore-core'), $widget_ops);
        $this->alt_option_name = 'etheme_widget_about_author';
    }

    function widget($args, $instance) {
        extract($args);

        $title     = apply_filters( 'widget_title', empty( $instance['title'] ) ? false : $instance['title'] );
        $caption   = ( !empty($instance['caption'] ) ) ? $instance['caption'] : '';
        $bio       = ( !empty($instance['bio'] ) ) ? $instance['bio'] : '';
        $image     = ( !empty($instance['image'] ) ) ? $instance['image'] : '';
        $autograph = ( !empty($instance['autograph'] ) ) ? $instance['autograph'] : '';

        echo $before_widget;
        if( ! $title == '' ){
	        echo $before_title . $title . $after_title;
        }
        ?>
        	<?php if ( ! empty( $image ) ): ?>
				<img src="<?php echo $image; ?>" alt="<?php echo $caption; ?>" title="<?php echo $caption; ?>">
        	<?php endif ?>
        	<?php if ( ! empty( $caption ) ): ?>
				<h4><?php echo $caption; ?></h4>
        	<?php endif ?>
        	<?php if ( ! empty( $bio ) ): ?>
				<p class="author-bio"><?php echo $bio; ?></p>
        	<?php endif ?>
        	<?php if ( ! empty( $autograph ) ): ?>
				<img src="<?php echo $autograph; ?>" alt="<?php echo $caption; ?>" title="<?php echo $caption; ?>">
        	<?php endif ?>
        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['caption'] = $new_instance['caption'];
        $instance['bio'] = $new_instance['bio'];
        $instance['image'] = $new_instance['image'];
        $instance['autograph'] = $new_instance['autograph'];

        if (function_exists ( 'icl_register_string' )){
            icl_register_string( 'Widgets', 'Author Widget - caption field', $instance['caption'] );
            icl_register_string( 'Widgets', 'Author Widget - bio field', $instance['bio'] );
        }

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $caption = isset($instance['caption']) ? $instance['caption'] : '';
        $bio = isset($instance['bio']) ? $instance['bio'] : '';
        $image = isset($instance['image']) ? $instance['image'] : '';
        $autograph = isset($instance['autograph']) ? $instance['autograph'] : '';
		
		etheme_widget_input_text( esc_html__( 'Title', 'xstore-core' ), $this->get_field_id( 'title' ),$this->get_field_name( 'title' ), $title );
		etheme_widget_input_image( esc_html__( 'Image', 'xstore-core' ), $this->get_field_id( 'image' ),$this->get_field_name( 'image' ), $image );
		etheme_widget_input_text( esc_html__( 'Caption', 'xstore-core' ), $this->get_field_id( 'caption' ),$this->get_field_name( 'caption' ), $caption );
		etheme_widget_textarea( esc_html__( 'Bio', 'xstore-core' ), $this->get_field_id( 'bio' ),$this->get_field_name( 'bio' ), $bio );
		etheme_widget_input_image( esc_html__( 'Autograph image', 'xstore-core' ), $this->get_field_id( 'autograph' ),$this->get_field_name( 'autograph' ), $autograph );
    }
}