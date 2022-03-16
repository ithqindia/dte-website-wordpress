<?php

include_once 'testimonials-list.php';

foreach ( glob( MILDHILL_CORE_INC_PATH . '/post-types/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}