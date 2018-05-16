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
            add_options_page( 'Fancy Slider Settings', 'Fancyslider', 'manage_options', 'fancy-slider','fs_option_page_callback' );
        } 

        /**
        * function to add settings section and field,register setting *
        *@since 0.1.0
        *@var function
        *@return void
        *@param 
        *@access private
        **/
        private function menu_page_settings_init(){
            $counter = 0;
            $pages = array(
                'fancy-slider'
            );

            $sections = array(
                'fancy_slider_section_basic',
                'fancy_slider_section_advanced'
            );

            $std_no = array(
                'id'  => 'fs_std_no',
                'label' => array(
                    'sli_qty' => 'Sliders Quantity',
                    'scr_qty' => 'Scrolls Quantity',
                    'ap_spd'  => 'Slider Autopaly Speed',
                    'trs_spd' => 'Slider Transition Speed'
                )                                   
            );
            $std_slt = array(
                'id' => 'fs_std_slt',
                'label'=>  array(
                    'ap' => 'Slider Autoplay',
                    'fd' => 'Slider Fade Effect',
                    'dot'=> 'Slider Dot Indicator',
                    'inf'=> 'Slider Infinite Loop'
                )
            );

            $ctr_slt = array(
                'ctr_md' => 'Slider Centre Mode',
            );
            $ctr_txt = array(
                'ctr_pd' => 'Slider Padding'
            );
            
            $field_params = array(

                'section_basic_params' => array(
                    'Slider-Standard-Settings-1' => array( 'fs_std_no','fs_field_callback_number',$std_no ),
                    'Slider-Standard-Settings-2' => array( 'fs_std_slt','fs_field_callback_select',$std_slt ),
                ),
                'section_advanced_params' => array(
                   /* to be continued */
                )
            );
  
            foreach ($field_params as $key => $value ) {
               
                foreach ($value as $name => $array) {  
                    $_name = str_replace('-', ' ', $name);
                    /*  add_settings_field( $id, $title, $callback, $page, $section, $args) */
                    add_settings_field( "{$array[0]}", 
                                        "{$_name}", 
                                        "{$array[1]}",
                                        "{$pages[0]}", 
                                        "{$sections[$counter]}", 
                                        $array[2] );
                }
                $counter++;
            }

            /* add_settings_section($id, $title, $callback, $page) */
            add_settings_section( "{$sections[0]}", 'Slider Basic Settings', 'fs_section_callback_basic', "{$pages[0]}");

            add_settings_section( "{$sections[1]}", 'Slider Advanced Settings', 'fs_section_callback_advanced', "{$pages[0]}");
            /* register_setting($option_group_name,$option_name,$sanitize_callback) */
            register_setting( 'fancy_slider_option_gp', 'fancy_slider_options' ,array('sanitize_callback' => 'fs_sanitize_options') );
        }

         /**
        * function to be used as callable name hooked onto add filter *
        *@since 0.1.0
        *@var function
        *@return array      
        *@access protected
        **/
        protected function get_options(){
            $fancy_slider_options = get_option( 'fancy_slider_options');
            return $fancy_slider_options;
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
                },
                'get_options_hook' => function(){
                    return $this->get_options();
                }
            );
        
        }

       
    }
}