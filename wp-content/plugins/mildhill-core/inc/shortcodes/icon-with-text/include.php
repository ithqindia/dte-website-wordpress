<?php

include_once 'icon-with-text.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/shortcodes/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}