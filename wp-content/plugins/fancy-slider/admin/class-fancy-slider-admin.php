<?php  

/**
 * class  Fancy_Slider_Admin,all related to wordpress admin page functionalities *
 *@since 0.1.0
 *@var class
 *@package fancy-slider
 *@subpackage fancy-slider/admin
 *@author Hai
**/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Fancy_Slider_Admin' )) {

    class Fancy_Slider_Admin  {

        /**
        * name identifier particpating into wordpress actions *
        *@since 0.1.0
        *@var string
        *@access protected
        **/
        protected static $_name; 

        /**
        * version identifier particpating into wordpress actions *
        *@since 0.1.0
        *@var string
        *@access protected
        **/
        protected static $_version;

        /**
        * version identifier particpating into wordpress actions *
        *@since 0.1.0
        *@var string
        *@access protected
        **/
        protected static $_url;

        /**
        * construct function for obtaining name and version identifiers *
        *@since 0.1.0
        *@var function
        *@return void
        *@param $name,$version
        **/
        public function __construct($name,$version){
            self::$_name    = $name;
            self::$_version = $version;
        } 

        /**
        * function to register a new custom post type  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
        private static function custom_post_type_init(){
            $labels =array(
                'name'          => __('Sliders','yee-slider'),
                'singular_name' => __('Slider','yee-slider'),
                'menu_name'     => __('Sliders','yee-slider'),
                'add_new'       => __('Add New','yee-slider'),
                'add_new_item'  => __('Add New Slider','yee-slider'),
                'new_item'      => __('New Slider','yee-slider'),
                'edit_item'     => __('Edit slider','yee-slider'),
                'view_item'     => __('View Slider','yee-slider'),
                'all_items'     => __('All Sliders','yee-slider'),
                'search_items'  => __('Search Sliders','yee-slider'),         
                );    
            $args =array( 'labels'          => $labels,
            		  'public'             => true,
            		  'publicly_queryable' => true,
            		  'show_ui'            => true,
            		  'show_in_menu'       => true,
            		  'query_var'          => true,
            		  'rewrite'            => array( 'slug' => 'slider' ),
            		  'capability_type'    => 'post',
            		  'has_archive'        => true,
            		  'hierarchical'       => false,
            		  'menu_position' => 5,
            		  'menu_icon'     => 'dashicons-format-gallery',
            		  'supports'      => array('title','editor','thumbnail','excerpt'),
            		);         
            register_post_type('fancy_slider',$args);
        }

        /**
        * function to enqueue new scripts  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
        private static function admin_scripts_enqueue(){
            wp_enqueue_script( self::$_name, plugin_dir_url( __FILE__ ) . 'js/fancy-slider-admin.js', array( 'jquery' ),self::$_version , true );
        }

        /**
        * function to enqueue new styles  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
        private static function admin_styles_enqueue(){
            wp_enqueue_style( self::$_name, plugin_dir_url( __FILE__ ) . 'css/fancy-slider-admin.css', array(), self:: $_version, 'all' );
        }

        /**
        * interface to invoke private function - -custom post type *
        *@since 0.1.0
        *@var function
        *@return void
        **/
    	public function custom_post_type_interface(){
    		self::custom_post_type_init();
    	} 

        /**
        * interface to invoke private function - -enqueue scripts *
        *@since 0.1.0
        *@var function
        *@return void
        **/
    	public function admin_scripts_enqueue_interface(){
    	    self::admin_styles_enqueue();
    	    self::admin_scripts_enqueue();    
    	}

        /**
        * fetch featured images from custom posts *
        *@since 0.1.0
        *@var function
        *@return array
        *@access private
        **/
        private static function fancy_slider_featured_img(){

            $fancy_slider_posts = get_posts( array( 'post_type' =>'fancy_slider' ) );
            $url = '<div class="fancy-slider">';
            foreach ( $fancy_slider_posts as $post ){
                setup_postdata( $post );
                $feature_img = get_post_thumbnail_id( $post->ID );
                if ( $feature_img ){
                    $img = wp_get_attachment_image_src( $feature_img ,'full');
                    $url .= "<div> <img src= '$img[0]'> </div>";
                }          
            }
            $url .= '</div>';
            wp_reset_postdata();
            echo $url;
        }

        /**
        * nterface to invoke private function - -fancy_slider_featured_img *
        *@since 0.1.0
        *@var function
        *@return void
        **/
        public static function admin_cpt_featured_img_interface(){
            self::fancy_slider_featured_img();
        }
       
    }

}