<?php

/*************** YITH PRODUCT SALES COUNTDOWN CONTENT FILTERS - begin ***************/

// Remove all instances of product countdown injected by plugin on product single, we will add it as function where we need it...
remove_action( 'woocommerce_before_single_product', array(
	YITH_WC_Product_Countdown::get_instance(),
	'check_show_ywpc_product'
), 5 );

// Remove all instances of product countdown injected by plugin on shop archive, we will add it as function where we need it...
remove_action( 'woocommerce_before_shop_loop_item', array(
	YITH_WC_Product_Countdown::get_instance(),
	'check_show_ywpc_category'
) );


/*************** YITH PRODUCT SALES COUNTDOWN CONTENT FILTERS - end ***************/