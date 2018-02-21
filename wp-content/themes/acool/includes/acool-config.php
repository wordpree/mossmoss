<?php
/**
 * An example file demonstrating how to add all controls.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       3.0.12
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * First of all, add the config.
 *
 * @link https://aristath.github.io/kirki/docs/getting-started/config.html
 */
Kirki::add_config(
	'acool_setting', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);


//images url
$imagepath =  get_stylesheet_directory_uri() . '/images/'; 


/**
 * Add a panel.
 *
 * @link https://aristath.github.io/kirki/docs/getting-started/panels.html
 */
Kirki::add_panel(
	'theme_panel', array(
		'priority'    => 19,
		'title'       => esc_attr__( 'Acool Theme Settings', 'acool' ),
	)
);

/**
 * Add sections.
 */
Kirki::add_section( 'general_theme_option', array(
    'title'          => esc_attr__( 'General Theme Setting', 'acool' ),
    'panel'          => 'theme_panel',
    'priority'       => 160,
) );


Kirki::add_section( 'homepage_banner_option', array(
    'title'          => esc_attr__( 'Homepage banner section', 'acool' ),
    'panel'          => 'theme_panel',
	'description' =>  __('Must enable the Featured Homepage, and set up a Static Front Page, the banner will be displayed!', 'acool'), 
    'priority'       => 160,
) );

Kirki::add_section( 'homepage_blog_option', array(
    'title'          => esc_attr__( 'Homepage blog section', 'acool' ),
    'panel'          => 'theme_panel',
	'description' =>  __('Must enable the Featured Homepage, and set up a Static Front Page, the banner will be displayed!', 'acool'), 
    'priority'       => 160,
) );

/**
 * A proxy function. Automatically passes-on the config-id.
 *
 * @param array $args The field arguments.
 */
function acool_add_field( $args ) {
	Kirki::add_field( 'acool_setting', $args );
}



/**======section colors =======**/
acool_add_field(
	array(
		'type'        => 'color',
		'settings'    => 'header_bgcolor',
		'label'       => __( 'Header Background Color', 'acool' ),
		'section'     => 'colors',
		'default'     => '#ffffff',
		'priority'    => 10,
 	
	)
);

acool_add_field(
	array(
		'type'        => 'color',
		'settings'    => 'content_link_color',
		'label'       => __( 'Content links color', 'acool' ),
		'section'     => 'colors',
		'default'     => '#03a325',
		'priority'    => 10,
	)
);

acool_add_field(
	array(
		'type'        => 'color',
		'settings'    => 'content_link_hover_color',
		'label'       => __( 'Content links hover color', 'acool' ),
		'section'     => 'colors',
		'default'     => '#0c8432',
		'priority'    => 10,
	)
);


acool_add_field(
	array(
		'type'        => 'color',
		'settings'    => 'other_link_color',
		'label'       => __( 'Other links color', 'acool' ),
		'section'     => 'colors',
		'default'     => '#3a3a3a',
		'priority'    => 10,
			
	)
);

acool_add_field(
	array(
		'type'        => 'color',
		'settings'    => 'other_link_hover_color',
		'label'       => __( 'Other links hover color', 'acool' ),
		'section'     => 'colors',
		'default'     => '#0c8432',
		'priority'    => 10,
			
	)
);
/**======section colors end=======**/





/**======general_theme_option=======**/
acool_add_field(
	array(
		'type'			 => 'custom', //toggle
		'settings'		 => 'info',
		'title'		=> __( 'Theme Settings', 'acool' ),
         'description' => '<p class="documentation-text">' . __('1. Documentation for Acool can be found <a target="_blank" href="https://www.coothemes.com/doc/acool-manual.php">here</a>', 'acool') . '</p><p class="documentation-text">' . __('2. A full theme demo can be found <a target="_blank" href="https://www.coothemes.com/themes/acool.php">here</a>', 'acool') . '</p>', 		
		'section'		 => 'general_theme_option',
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'show_search_icon',
		'label'			 => __( 'Show Search Icon', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 1,
		'priority'		 => 10,
	)
);

acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'box_header_center',
		'label'			 => __( 'Box Header Center', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 0,
		'priority'		 => 10,
	)
);

acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'enable_query_loader',
		'label'			 => __( 'Enable Query Loader', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 0,
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'fixed_header',
		'label'			 => __( 'Fixed Header', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 0,
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'        => 'select',
		'settings'    => 'header_opacity',
		'label'       => esc_attr__( 'Header Opacity', 'acool' ),
		//'description' => esc_attr__( 'The description here.', 'acool' ),
		'section'     => 'general_theme_option',
		'default'     => '0.4',
		'placeholder' => esc_attr__( 'Select an option', 'acool' ),
		'choices'  => array('0.1'=> '0.1','0.2'=> '0.2','0.3'=> '0.3','0.4'=> '0.4','0.5'=> '0.5','0.6'=> '0.6','0.7'=> '0.7','0.8'=> '0.8','0.9'=> '0.9','1'=> '1'),
	)
);

acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'enable_breadcrumb_check',
		'label'			 => __( 'Breadcrumb', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 1,
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'display_footer_widget_area',
		'label'			 => __( 'Display Footer Widget Area', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 1,
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'hide_post_meta',
		'label'			 => __( 'Hide Post Meta', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 0,
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'			 => 'switch', //toggle
		'settings'		 => 'hide_login_menu',
		'label'			 => __( 'Hide Login Menu', 'acool' ),
		'section'		 => 'general_theme_option',
		'default'		 => 0,
		'priority'		 => 10,
	)
);


acool_add_field(
	array(
		'type'        => 'textarea',
		'settings'    => 'footer_info',
		'label'       => esc_attr__( 'Footer text', 'acool' ),
		'section'     => 'general_theme_option',
		'default'     => __('Copyright 2018', 'acool'),
	)
);



/**======homepage_option=======**/

//banner
acool_add_field(
	array(
		'type'        => 'image',
		'settings'    => 'homepage_banner_img',
		'label'       => esc_attr__( 'Homepage Banner Image (URL)', 'acool' ),
		'section'     => 'homepage_banner_option',
		'default'     => $imagepath.'banner1.jpg',
	)
);

acool_add_field(
	array(
		'type'        => 'text',
		'settings'    => 'homepage_banner_button_url',
		'label'       => esc_attr__( 'Homepage Banner Button Url', 'acool' ),
		'section'     => 'homepage_banner_option',
		'default'     => '#',
	)
);

acool_add_field(
	array(
		'type'        => 'text',
		'settings'    => 'homepage_banner_text_h1',
		'label'       => esc_attr__( 'Homepage Banner Text H1', 'acool' ),
		'section'     => 'homepage_banner_option',
		'default'     => __('The jQuery slider that just slides.', 'acool'),
	)
);

acool_add_field(
	array(
		'type'        => 'textarea',
		'settings'    => 'homepage_banner_text',
		'label'       => esc_attr__( 'Homepage Banner Text', 'acool' ),
		'section'     => 'homepage_banner_option',
		'default'     => __('No fancy effects or unnecessary markup.', 'acool'),
	)
);

acool_add_field(
	array(
		'type'        => 'text',
		'settings'    => 'homepage_banner_button_text',
		'label'       => esc_attr__( 'Homepage Banner Button Text', 'acool' ),
		'section'     => 'homepage_banner_option',
		'default'     => __('Download', 'acool'),
	)
);

//blog


acool_add_field(
	array(
		'type'        => 'text',
		'settings'    => 'homepage_post_list_h1',
		'label'       => esc_attr__( 'Homepage Post List Title', 'acool' ),
		'section'     => 'homepage_blog_option',
		'default'     => __('Blog posts', 'acool'),
	)
);

acool_add_field(
	array(
		'type'        => 'textarea',
		'settings'    => 'homepage_post_list_text',
		'label'       => esc_attr__( 'Homepage Post List Text', 'acool' ),
		'section'     => 'homepage_blog_option',
		'default'     => __('Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere.', 'acool'),
	)
);


acool_add_field(
	array(
		'type'        => 'select',
		'settings'    => 'homepage_post_list_num',
		'label'       => esc_attr__( 'Homepage Post List Number', 'acool' ),
		'section'     => 'homepage_blog_option',
		'default'     => '6',
		'placeholder' => esc_attr__( 'Select an option', 'acool' ),
		'choices'  => array('3'=> '3','6'=> '6','9'=> '9','12'=> '12'),
	)
);


acool_add_field(
	array(
		'type'        => 'text',
		'settings'    => 'homepage_blog_url',
		'label'       => esc_attr__( 'Blog Url', 'acool' ),
		'section'     => 'homepage_blog_option',
		'default'     => esc_url(home_url('/')).'blog/',
	)
);

function get_categories_select() {
 $teh_cats = get_categories();
 
// print_r($teh_cats);
	$results;
	$count = count($teh_cats);
	for ($i=0; $i < $count; $i++) {
	  if (isset($teh_cats[$i]))
		$results[$teh_cats[$i]->cat_ID] = $teh_cats[$i]->name;
	  else
		$count++;
	}
  return $results;
}	

acool_add_field(
	array(
		'type'        => 'multicheck',
		'settings'    => 'post_list_cat',
		'label'       => esc_attr__( 'Select Categories to display on Homepage', 'acool' ),
		'section'     => 'homepage_blog_option',
		'default'     => 'uncategorized',
		'placeholder' => esc_attr__( 'Select an option', 'acool' ),
		'choices'  => get_categories_select(),
	)
);