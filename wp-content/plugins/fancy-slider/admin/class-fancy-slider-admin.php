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
require_once plugin_dir_path( __FILE__ ) . 'view/fancy-slider-settings.php' ;

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
        * function reference array handle * 
        *@since 0.1.0
        *@var string
        *@access protected
        **/
        public $_handle;
        
        /**
        * construct function for obtaining name ,version identifiers and handle init *
        *@since 0.1.0
        *@var function
        *@return void
        *@param $name,$version
        **/
        public function __construct($name,$version){

            self::$_name    = $name;
            self::$_version = $version;
            $this->admin_entry();
        } 

        /**
        * function to register a new custom post type  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
        private  function custom_post_type_init(){
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
        private  function scripts_enqueue(){
            wp_enqueue_script( self::$_name, plugin_dir_url( __FILE__ ) . 'js/fancy-slider-admin.js', array( 'jquery' ),self::$_version , true );
        }

        /**
        * function to enqueue new styles  *
        *@since 0.1.0
        *@var function
        *@return void
        *@access private
        **/
        private  function styles_enqueue(){
            wp_enqueue_style( self::$_name, plugin_dir_url( __FILE__ ) . 'css/fancy-slider-admin.css', array(), self:: $_version, 'all' );
        }

        /**
        * function to creat new submenu page under settings panel  *
        *@since 0.1.0
        *@var function
        *@return void
        *@param add_options_page ($page_tile ,$menu_title,$cability,$menu_slug,$function )
        *@access private
        **/
        private function options_page(){
            add_options_page( 'Fancy Slider Settings', 'Fancyslider', 'manage_options', 'fancy-slider','fancy_slider_option_page_callback' );
        } 

        function menu_page_settings_init(){
            add_settings_section( 'fancy_slider_section_mode', 'Slider Mode Settings', 'fancy_slider_section_callback_mode', 'fancy-slider');

            add_settings_section( 'fancy_slider_section_advanced', 'Slider Advanced Settings', 'fancy_slider_section_callback_advanced', 'fancy-slider');

            add_settings_field( 'fade_mode', 'Fade Item Mode', 'fancy_slider_field_callback_fade', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) );

            add_settings_field( 'sync_mode', 'Sync Item Mode', 'fancy_slider_field_callback_sync', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) );  
            
            add_settings_field( 'single_mode', 'Single Item Mode', 'fancy_slider_field_callback_single', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) );

            add_settings_field( 'center_mode', 'Center Item Mode', 'fancy_slider_field_callback_center', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) );

            add_settings_field( 'multiple_mode', 'Multiple Item Mode', 'fancy_slider_field_callback_multiple', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) );

            add_settings_field( 'atribute_mode', 'Atribute Item Mode', 'fancy_slider_field_callback_atribute', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) ); 

            add_settings_field( 'responsive_mode', 'Responsive Item Mode', 'fancy_slider_field_callback_responsive', 'fancy-slider', 'fancy_slider_section_mode', array( '' ) );

            register_setting( 'fancy-slider_option_gp', 'fancy-slider_options' ,array('type' => 'text') );
        }

         /**
        * variable function to be used as callable name hooked onto wp actions  *
        *@since 0.1.0
        *@var function
        *@return void      
        *@access protected
        **/
        protected function admin_entry(){
            $this->_handle = array(
                'cpt_init_hook' => function(){
                    $this->custom_post_type_init();
                },
                'scripts_enqueue_hook' => function(){
                    $this->styles_enqueue();
                    $this->scripts_enqueue(); 
                },
                'options_page_hook' => function(){
                    $this->options_page();
                },
                'menu_page_settings_init_hook' => function(){
                    $this->menu_page_settings_init();
                }
            );
        
        }

       
    }

}