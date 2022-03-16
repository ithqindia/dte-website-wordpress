<?php
include_once 'hover-animations.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/post-types/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}