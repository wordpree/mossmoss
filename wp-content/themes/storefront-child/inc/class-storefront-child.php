<?php 
if(!defined('ABSPATH')){
	exit;
}
if ( !class_exists( 'Storefront_Child_Class' ) ){

	class Storefront_Child_Class {
		public function __construct(){
			add_action( 'init', array($this, 'register_menus' ),10 );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts', array($this,'scripts_enqueue') ,21);
		}

		public function register_menus(){
			register_nav_menus( array(
                'left'=>__('Left Menu','Storefront-Child'),
				'right'=>__('Right Menu','Storefront-Child')
			) );
		}
	    
	    public function widgets_init(){
	    	$args = array(
			    'name' => __('Before Main Content','storefront-child'),
			    'id'   => 'before_main_content',
			    'description' => 'Widgets added here will be displayed immediately before main content area'
	    	);
	    	register_sidebar( $args );
	    } 

	    public function scripts_enqueue(){
            wp_enqueue_style('storefront-style',get_template_directory_uri().'/style.css');
	        wp_enqueue_style('storefront-child-style',get_stylesheet_directory_uri().'/assets/sass/style.css',array('storefront-style'),'v4.17');
	        wp_enqueue_style('fancyslider-style',get_stylesheet_directory_uri().'/assets/fancyslider.css',array(),'v9.19');	
	        wp_enqueue_script('storefront-child-jquery',get_stylesheet_directory_uri().'/assets/js/vendor/jquery-3.2.1.min.js');
	        wp_enqueue_script('fancySlider',
					  get_stylesheet_directory_uri().'/assets/js/jquery.fancyslider.js',array('jquery'),'v0907',false);	
	        wp_enqueue_script('storefront-child-frontpage',get_stylesheet_directory_uri().'/assets/js/storefront-child-frontpage.js',array('jquery'),'v0908',true);
	        wp_localize_script( 'storefront-child-frontpage', 'fancy_slider_settings', apply_filters( 'fancy_slider_localize', array() ));
	    }
	    
	}
}

return new Storefront_Child_Class();