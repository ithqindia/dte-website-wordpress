<?php

include_once 'product-list.php';

foreach ( glob( MILDHILL_CORE_INC_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}