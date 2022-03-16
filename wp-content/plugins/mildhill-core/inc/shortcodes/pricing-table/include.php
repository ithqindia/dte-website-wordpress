<?php

include_once 'pricing-table.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/shortcodes/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}