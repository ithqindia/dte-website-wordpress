<?php

include_once 'call-to-action.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/shortcodes/call-to-action/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}