<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			mildhill_core_theme_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			mildhill_core_theme_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			mildhill_core_theme_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			mildhill_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image' );
			break;
	} ?>
</div>