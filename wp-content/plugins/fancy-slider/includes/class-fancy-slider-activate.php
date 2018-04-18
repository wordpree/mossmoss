<?php 
if ( ! class_exists( 'fancy_slider_activate' ) ){

	class fancy_slider_activate {
		public function __construct(){
			add_action( 'init', array($this,'fancy_slider_custom_post_type_init') );
			flush_rewrite_rules();
		}

		public function fancy_slider_custom_post_type_init(){
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

			$args =array('labels'        => $labels,
					  'public'        => true,
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
					  'supports'      =>array('title','editor','thumbnail','excerpt'),
					 );

			register_post_type('slider',$args);
		}
	}


}
