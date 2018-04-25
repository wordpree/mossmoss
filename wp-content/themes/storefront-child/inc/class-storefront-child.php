<?php 
if(!defined('ABSPATH')){
	exit;
}
if ( !class_exists( 'storefront_child_class' ) ){

	class storefront_child_class {
		public function __construct(){
			add_action( 'init', array($this, 'storefront_child_register_menus' ),10 );
			add_action( 'widgets_init', array( $this, 'storefront_child_widgets_init' ) );
		}

		public function storefront_child_register_menus(){
			register_nav_menus( array(
                'left'=>__('Left Menu','Storefront-Child'),
				'right'=>__('Right Menu','Storefront-Child')
			) );
		}
	    
	    public function storefront_child_widgets_init(){
	    	$args = array(
			    'name' => __('Before Main Content','storefront-child'),
			    'id'   => 'before_main_content'
	    	);
	    	register_sidebar( $args );
	    } 
	}
}

return new storefront_child_class();