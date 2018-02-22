<?php 
if(!defined('ABSPATH')){
	exit;
}
if (!class_exists('storefront_child_class')){

	class storefront_child_class {
		public function __construct(){
			add_action('init',array($this,'storefront_child_register_menus'),10);
		}
		public function storefront_child_register_menus(){
			register_nav_menus( array(
                'left'=>__('Left Menu','Storefront-Child'),
				'right'=>__('Right Menu','Storefront-Child')
			) );
		}
	}
}

return new storefront_child_class();