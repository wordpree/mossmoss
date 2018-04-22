<?php 

/**
 * Class  Fancy_Slider_Public,all related to wordpress none-admin page functionalities *
 *@since 0.1.0
 *@var class
 *@package fancy-slider
 *@subpackage fancy-slider/public
 *@author Hai
**/

if (! class_exists( 'Fancy_Slider_Public' ) ) {

	class Fancy_Slider_Public {
        /**
        * name identifier particpating into wordpress actions *
        *@since 0.1.0
        *@var string
        *@access protected
        **/		
	    protected static $_name;

        /**
        * name identifier particpating into wordpress actions *
        *@since 0.1.0
        *@var string
        *@access protected
        **/	    
	    protected static $_version;

        /**
        * construct function for obtaining name and version identifiers *
        *@since 0.1.0
        *@var function
        *@return void
        *@param $name,$version
        **/
	    public function __construct($name ,$version){
			self::$_name = $name;
			self::$_version = $version;
	    }

        /**
        * function to enqueue new styles  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
	    private static function public_styles_enqueue(){
	    	wp_enqueue_style( self::$_name, plugin_dir_url( __FILE__ ) . 'css/fancy-slider-public.css', array(), self::$_version, 'all' );
	    }

        /**
        * function to enqueue new scripts  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
	    private static function public_scripts_enqueue(){
	    	wp_enqueue_script( self::$_name, plugin_dir_url( __FILE__ ) . 'css/fancy-slider-public.js', array('jquery'), self::$_version, true);
	    }
	    
        /**
        * interface to invoke private function - -enqueue scripts*
        *@since 0.1.0
        *@var function
        *@return void
        **/
	    public function public_scripts_interface(){
		    self::public_styles_enqueue();
		    self::public_scripts_enqueue();
	    }
	}
}