<?php

include_once 'countdown.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/shortcodes/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}