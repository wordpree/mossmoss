<?php
/*
** create time  : 04-2017
** last modify  : 2-2018
** author: create by Hai
** description:register
** notice :generally ,enqueue files are under assets folder located in theme directory
** modification record && time:
**                      1.modified style enqueue path to new structure && 03-02-2018
**                      2.modified style enqueue path to new structure && 06-02-2018
**                      3.
**                      4.
**                      5.
*/
/*nav menu register*/
function register_yee_menus(){
	register_nav_menus(
	  array(
		'left'=>__('Left Menu','Storefront-Child'),
		'right'=>__('Right Menu','Storefront-Child'),
		'mini'=>__('Mini Menu','Storefront-Child')
	  )
	);
}
add_action('init','register_yee_menus');

/*enqueue child style*/
function storefront_child_scripts_enqueue(){
	wp_enqueue_style('storefront-style',get_template_directory_uri().'/style.css');
	wp_enqueue_style('storefront-child-style',get_stylesheet_directory_uri().'/assets/sass/style.css',array('storefront-style'),'v4.17');
	wp_enqueue_style('storefront-child-main-style',get_stylesheet_directory_uri().'/assets/sass/style.css',array(''),'v2.18');
	wp_enqueue_style('fancyslider-style',get_stylesheet_directory_uri().'/assets/fancyslider.css',array(),'v9.19');
	
	wp_enqueue_script('storefront-child-jquery',get_stylesheet_directory_uri().'/assets/js/vendor/jquery-3.2.1.min.js');
	wp_enqueue_script('fancySlider',
					  get_stylesheet_directory_uri().'/assets/js/jquery.fancyslider.js',array('jquery'),'v0907',false);
	
	wp_enqueue_script('storefront-child-frontpage',get_stylesheet_directory_uri().'/assets/js/storefront-child-frontpage.js',array('jquery'),'v0908',true);
}
add_action('wp_enqueue_scripts','storefront_child_scripts_enqueue',21);


/*wooCommerce actived or not*
*@see storefront-child-template-hooks.php
*/
$storefront_child_is_woocommerce_actived = class_exists( 'WooCommerce' ) ? true : false;




/*register slider post type*/
function yee__post_type_slider_init(){
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

 register_post_type('yee_slider',$args);
}
add_action('init','yee__post_type_slider_init');

/*register testimonial post type*/
function yee_post_type_testimonial_init(){
	$labels =array(
		'name'=>'Testimonials',
		'sigular_name'=>'Testimonial',
		'add_new'=>__('Add New Testimonial','Storefront-Child'),
		'add_new_item'=>__('Add New Testimonial','Storefront-Child'),
		'edit_item'=>__('Edit Testimonial','Storefront-Child'),
		'new_item'=>__('New Testimonial','Storefront-Child'),
		'view_item'=>__('View Testimonial','Storefront-Child'),
		'view_items'=>__('View Testimonials','Storefront-Child'),
		'all_items'=>__('All Testimonials','Storefront-Child'),
		'search_items'=>__('Search Testimonials','Storefront-Child')
	);
	$args =array(
		'labels'=>$labels,
		'public'=>true,
		'menu_position'=>5,
		'menu_icon'=>'dashicons-visibility',
		'hierarchical'=>false,
		'has_archive'=>true,
		'supports'=>array('title','editor','thumbnail','excerpt'),
		'rewrite'=>array('slug'=>'testimonial')
		
	);
	register_post_type('yee_testimonial',$args);
}
add_action('init','yee_post_type_testimonial_init');

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    yee_post_type_testimonial_init();
    yee__post_type_slider_init();
    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );



function storefront_child_customizer_live_preview()
{
	wp_enqueue_script( 
		  'storefront-child-themecustomizer',			//Give the script an ID
		  get_stylesheet_directory_uri().'/assets/js/storefront-child-customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  'v0925',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'storefront_child_customizer_live_preview' );

/*svg upload suport*/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
/*skip cropping @see class-storefront.php line 78*/
function storefront_child_svg_skip_cropping(){
	add_theme_support( 'custom-logo', array(
				'height'      => 110,
				'width'       => 470,
				'flex-width'  => true,
				'flex-height'  => true,
			) );
}
add_action( 'after_setup_theme','storefront_child_svg_skip_cropping',30);