<?php
function acool_setup(){
	global $content_width;
	$lang = get_template_directory(). '/languages';
	load_theme_textdomain('acool', $lang);

	$args = array();
	$header_args = array( 
	    'default-image'          => '',
		'default-repeat'         => 'no-repeat',
        'default-text-color'     => '2C2C2C',
		'url'                    => '',
        'width'                  => 1920,
        'height'                 => 89,
        'flex-height'            => true
     );
	add_theme_support( 'custom-background', $args );
	add_theme_support( 'custom-header', $header_args );	
	add_theme_support( 'automatic-feed-links' );//
	add_theme_support( "title-tag" );//
	
	// set support  "Featured Image"
	add_theme_support('post-thumbnails'); 
	add_image_size('s475', 475, 475);

	add_theme_support( 'custom-logo', array(
			   'height'      => 52,
			   'width'       => 262,
			   'flex-width' => true,
			) );
	
	//register menus
	register_nav_menus(
					   array(
						'primary-menu' => __( 'Primary Menu', 'acool' ) ,
					   	'secondary-menu' => __( 'Secondary Menu', 'acool' ),
					   	'footer-menu' => __( 'footer Menu', 'acool' )	
					   )
					   );
					   
	add_editor_style("editor-style.css");
	if ( !isset( $content_width ) ) $content_width = 1170;
}
add_action( 'after_setup_theme', 'acool_setup' );


function acool_custom_scripts()
{
	global $is_IE;
	$theme_info = wp_get_theme();
	
	wp_enqueue_style('font-awesome-css',  get_template_directory_uri() .'/css/font-awesome.min.css', false, '4.5.0', false);
	wp_enqueue_style('bootstrap-css',  get_template_directory_uri() .'/css/bootstrap.min.css', false, '3.3.5', false);	
	wp_enqueue_style('acool-main', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ) );	
		
	//js

	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '3.3.5', false );	
	if(get_theme_mod( 'enable_query_loader',0))
	{
		wp_enqueue_script( 'queryloader2', get_template_directory_uri().'/js/queryloader2.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'acool-loader', get_template_directory_uri().'/js/loader.js', array( 'jquery' ), '', false );		
	}
	$fixed_header  =  get_theme_mod('fixed_header',0);	

	if($fixed_header ){		
		wp_enqueue_script( 'acool-fixed-header2', get_template_directory_uri().'/js/fixed-header2.js', array( 'jquery' ), '', false );		
	}
	

	wp_enqueue_script('scrollTo', get_template_directory_uri().'/js/jquery.scrollTo.min.js', array( 'jquery' ), '2.1.2', false );	

	//	
	wp_enqueue_script( 'waypoints', get_template_directory_uri().'/js/jquery.waypoints.min.js', array( 'jquery' ), $theme_info->get( 'Version' ), false );
	
	wp_enqueue_script('acool-js', get_template_directory_uri().'/js/common.js', array( 'jquery' ), $theme_info->get( 'Version' ), false );	
	wp_localize_script( 'acool-js', 'acool_params', array(
		'ajaxurl'        => admin_url('admin-ajax.php'),
		'themeurl' => get_template_directory_uri(),		
	));
			
}
  
if (!is_admin())
{
	add_action( 'wp_enqueue_scripts', 'acool_custom_scripts' );
}



//change tag cloud font size
add_filter('widget_tag_cloud_args','acool_set_tag_cloud_sizes');
function acool_set_tag_cloud_sizes($args)
{
	$args['smallest'] = 11;
	$args['largest'] = 19;
	return $args;
}

// Generating Live CSS
function acool_customize_css()
{
    ?>
		<style  id='acool_customize_css' type="text/css">
	<?php	
			$acool_custom_css = "";
			$header_image       = get_header_image();
			if (isset($header_image) && ! empty( $header_image ))
			{
				$acool_custom_css .= "header.ct_header_class{background:url(".esc_url($header_image). ");}\n";
			}
			
			if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() )
			{
				$header_textcolor  =  ' color:#' . get_header_textcolor() . ';';
				$acool_custom_css .=  '.ct_site_tagline,.ct_site_name{'.esc_attr($header_textcolor).'}';
				$acool_custom_css .=  '#ct-top-navigation nav#top-menu-nav ul li a,#ct_mobile_nav_menu ul li a{'.esc_attr($header_textcolor).'}';
				$acool_custom_css .=  '#ct-top-navigation nav#top-menu-nav ul li a:hover,#ct_mobile_nav_menu ul li a:hover{color:#0c8432}';	
				$acool_custom_css .=  '#ct_search_icon:before{'.esc_attr($header_textcolor).'}';
				$acool_custom_css .=  '.mobile_menu_bar:before{'.esc_attr($header_textcolor).'} ';	 
			}
			  
			if ( get_theme_mod( 'show_search_icon',1)) {				
				$acool_custom_css  .=  '#top-menu{ margin-right:10px;}';
				$acool_custom_css  .=  '#ct_top_search{ margin:18px 40px 0 0;}';
			}

			//------- customize css  -------
			$header_bgcolor = get_theme_mod( 'header_bgcolor','#ffffff' );
			$rbg = acool_hex2rgb($header_bgcolor);
			
			$header_opacity       =  get_theme_mod( 'header_opacity',0.4);
			$fixed_header         =  get_theme_mod( 'fixed_header',0);			
			


			if( $fixed_header  )
			{
				$acool_custom_css  .= ".fixed{ position: fixed; width: 100%; background: rgba(".$rbg[0].", ".$rbg[1].", ".$rbg[2].", ".$header_opacity.") !important;z-index:999;}.carousel-caption{bottom: 10%;top: 25%;}";
			}
			if( $fixed_header && is_front_page() )
			{
				$acool_custom_css  .= ".ct_single{padding-top:80px;}";
			}
						
			if($header_bgcolor !='')
			{
				$acool_custom_css  .='.site-header { background-color:'.$header_bgcolor.';}';
			}
			//$fixed_header         =  of_get_option("fixed_header") ;
			
			//$acool_custom_css  .=  '.ct_header_class_post_page{border-bottom-width: 1px;border-bottom-style: solid;	border-bottom-color: #EEE;}';	
			echo $header_bgcolor;		
			if($header_bgcolor == '#ffffff') 
			{
				$acool_custom_css  .= '.ct_header_class{border-bottom-width: 1px;border-bottom-style: solid;	border-bottom-color:#ece6e6;}';	
			}
			else
			{
				$acool_custom_css  .= '.ct_header_class{border-bottom-width: 1px;border-bottom-style: solid;	border-bottom-color:'.$header_bgcolor.';}';
			}
			
			if( $fixed_header && is_front_page() && !is_home() ){
				$acool_custom_css  .= ".ct_header_class{border-bottom-color: rgba(".$rbg[0].", ".$rbg[1].", ".$rbg[2].", ".$header_opacity.") !important;}";	
			}
			
		
			if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			{			
				$acool_custom_css  .= '.ct_site_name{ line-height:52px; }';	
			}
			if(get_theme_mod( 'box_header_center',0 ))
			{
				$acool_custom_css  .= '#ct-top-navigation{ margin:15px 0 0 0;}.ct_logo{ padding-left:20px;}';
			
			}

			if ( get_theme_mod( 'footer_info','')  )
			{
				$acool_custom_css  .= '.ct_social{ margin-top:15px;}';
			}
			
			$other_link_color      		= get_theme_mod( 'other_link_color','' );
			$other_link_hover_color 	= get_theme_mod('other_link_hover_color','' );			
			$content_link_color 		= get_theme_mod( 'content_link_color' ,'');			
			$content_link_hover_color 	= get_theme_mod('content_link_hover_color','' );			
			
			if( $other_link_color !='' )
			{
				$acool_custom_css  .= 'a:link, a:visited, a:focus,a{color:'.$other_link_color.';}';	
			}
			else
			{
				$acool_custom_css  .= 'a:link, a:visited, a:focus,a{color:#2b2b2b;}';
			}
			if( $other_link_hover_color !='' )
			{
				$acool_custom_css  .=  'a:hover{color:'.$other_link_hover_color.';}';	
			}
			else
			{
				$acool_custom_css  .=  'a:hover{color:#0c8432;}';
			}
			
			if( $content_link_color !='' )
			{				
				$acool_custom_css  .= '.post a,.page a{color: '.$content_link_color.';}';
			}
			else
			{
				$acool_custom_css  .= '.post a,.page a{color: #03a325;}';
			}
			if( $content_link_hover_color !='' )
			{
				$acool_custom_css  .=  '.post a:hover,.page a:hover{color: '.$content_link_hover_color.';text-decoration: none;}';
			}
			else
			{
				$acool_custom_css  .=  '.post a:hover,.page a:hover{color: #0c8432;text-decoration: none;}';
			}

			$acool_custom_css  .=  '@media screen and (max-width:900px){.fixed {position: inherit;}	}';
			
			
			$acool_custom_css   = esc_html($acool_custom_css);
			
			$acool_custom_css   = str_replace('&gt;','>',$acool_custom_css);			

			echo $acool_custom_css;
				
			?></style>
    <?php
}

add_action( 'wp_head', 'acool_customize_css');
add_action( 'customize_controls_print_styles', 'acool_customize_css' );


function acool_more_link($more_link, $more_link_text) {
	return str_replace($more_link_text, __( 'Read More...', 'acool' ), $more_link);
}
add_filter('the_content_more_link', 'acool_more_link', 10, 2); 