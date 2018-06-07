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
                'name'          => __('Sliders','fancy-slider'),
                'singular_name' => __('Slider','fancy-slider'),
                'menu_name'     => __('Sliders','fancy-slider'),
                'add_new'       => __('Add New','fancy-slider'),
                'add_new_item'  => __('Add New Slider','fancy-slider'),
                'new_item'      => __('New Slider','fancy-slider'),
                'edit_item'     => __('Edit slider','fancy-slider'),
                'view_item'     => __('View Slider','fancy-slider'),
                'all_items'     => __('All Sliders','fancy-slider'),
                'search_items'  => __('Search Sliders','fancy-slider'),         
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
            $settings = fs_settings_field();
            if ( is_array( $settings  ) ){
                foreach ($settings  as $section => $data) {

                    /* add_settings_section($id, $title, $callback, $page) */
                    add_settings_section( $section, $data['title'], 'fs_section_callback_' . $section, $data['page']);
                    $option_group = $data['option_group'];
                    foreach ( $data['fields'] as $field) {
                        $option_name =  $field['id'];                       
                        /* register_setting($option_group_name,$option_name,$sanitize_callback) */
                        register_setting( $option_group ,$option_name ,array('sanitize_callback' => $field['scb']) );
                        /*  add_settings_field( $id, $title, $callback, $page, $section, $args) */
                        add_settings_field( $field['id'],$field['sub_title'],$data['fcb'],$data['page'],$section,array( 'field'=>$field,'section'=>$section ) );
                    }
                }

            }
        }

        /**
        * function to be used as callable name hooked onto add filter *
        *@since 0.1.0
        *@var function
        *@return array      
        *@access private
        **/
        private function get_options(){
            $fancy_slider_options;
            $options = array(
                'wpfs_standard',
                'wpfs_lazyload',
                'wpfs_centre',
                'wpfs_autoplay',
                'wpfs_animation',
                'wpfs_format',
                'wpfs_sync',
                'wpfs_bp_ac',
                'wpfs_bp_xl',
                'wpfs_bp_l',
                'wpfs_bp_m',
                'wpfs_bp_s',              
            );
            foreach ( $options as $value ) {
                $key = str_replace('wpfs_', '', $value);
                $fancy_slider_options[$key] = get_option( $value );                
            }
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