<?php

include_once 'button.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/shortcodes/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}