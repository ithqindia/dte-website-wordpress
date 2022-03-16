<?php

include_once 'portfolio-list.php';

foreach ( glob( MILDHILL_CORE_INC_PATH . '/post-types/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}