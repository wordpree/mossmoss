<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
  	<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
<div class="ct_acool ">
	<header id="ct_header" class="ct_header_class site-header ct_header_class_post_page ">
    <div class="header_box <?php if(  get_theme_mod( 'box_header_center',0) ){echo 'container';}?>" >

        <div class="ct_logo ct_f_left">        
        <?php 
			if ( has_custom_logo() )
			{
		?>
			<div class="logo">	
				<?php the_custom_logo();?>
			</div>
       <?php
			}
		?>               
            <div class="name-box">
                <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="ct_site_name"><?php bloginfo('name');?></h1></a>
                <span class="ct_site_tagline"><?php bloginfo('description');?></span>
            </div>


        </div> <!--logo end-->

        <div id="ct-top-navigation">
            <nav id="top-menu-nav">
                <ul id="top-menu" class="nav">
					<?php				
                        if ( has_nav_menu( 'primary-menu' ) ) {
                             wp_nav_menu( array( 'theme_location' => 'primary-menu', 'items_wrap' => '%3$s','container' => false  ) );
                        }
						
						$hide_login_menu = get_theme_mod( 'hide_login_menu',0); 
						if( !$hide_login_menu)
						{
							acool_login_li();
						}
                    ?>
                    
                </ul>
            </nav>

            <?php do_action( 'ct_header_top' ); ?>
            
            <div id="ct_top_search">
            <?php 
				if ( get_theme_mod( 'show_search_icon',1) )
				{ 
					get_search_form();
				}
			?>
            </div>

        </div> <!-- #ct-top-navigation -->
        
    </div>
	</header>