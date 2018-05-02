<?php
/*the functions.php of a child theme does not override its counterpart from the parent. 
Instead, it is loaded in addition to the parent’s functions.php. 
(Specifically, it is loaded right before the parent’s file.) */
require 'inc/storefront-child-functions.php';
require 'inc/storefront-child-template-hooks.php';
require 'inc/storefront-child-template-functions.php';
require 'inc/class-storefront-child-customizer.php';
require 'inc/class-storefront-child.php'; 
//require 'inc/woocommerce/class-storefront-woocommerce.php';
