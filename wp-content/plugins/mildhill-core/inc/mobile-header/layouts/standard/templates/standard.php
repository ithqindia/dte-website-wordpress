<?php

// Include mobile navigation opener
mildhill_core_template_part( 'mobile-header', 'templates/parts/mobile-navigation-opener' );

// Include mobile logo
mildhill_core_get_mobile_header_logo_image();
?>
<div class="qodef-widget-holder">
	<?php
	// Include mobile haeder widget area
	dynamic_sidebar( 'qodef-mobile-header-widget-area' );

	?>
</div>

<?php

// Include mobile navigation
mildhill_core_template_part( 'mobile-header', 'templates/parts/mobile-navigation' );
?>
