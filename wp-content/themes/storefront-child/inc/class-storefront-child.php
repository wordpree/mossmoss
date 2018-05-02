<?php 
if(!defined('ABSPATH')){
	exit;
}
if ( !class_exists( 'Storefront_Child_Class' ) ){

	class Storefront_Child_Class {
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
			    'id'   => 'before_main_content',
			    'description' => 'Widgets added here will be displayed immediately before main content area'
	    	);
	    	register_sidebar( $args );
	    } 
	}
}

return new Storefront_Child_Class();