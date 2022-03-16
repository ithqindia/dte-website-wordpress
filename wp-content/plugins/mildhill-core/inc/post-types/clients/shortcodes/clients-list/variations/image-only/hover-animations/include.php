<?php

include_once 'hover-animations.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/post-types/clients/shortcodes/clients-list/variations/image-only/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}