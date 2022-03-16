<?php

include_once 'banner.php';
foreach ( glob( MILDHILL_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
    include_once $variation;
}