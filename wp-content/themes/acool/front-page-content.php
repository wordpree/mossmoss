<?php 
	get_header();	
	$homepage_banner_img_deault = esc_url(get_stylesheet_directory_uri().'/images/banner1.jpg');
	
	
	
?>

        <section class="ct_section ct_section_slider">
            <div id="carousel-acool-generic" class="carousel slide" data-ride="carousel" data-interval="5000" >
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?php echo get_theme_mod( 'homepage_banner_img',$homepage_banner_img_deault);?> "  width="100%"/>
                        <div class="carousel-caption">
                            <h1><?php echo esc_html(get_theme_mod( 'homepage_banner_text_h1',__( 'The jQuery slider that just slides.', 'acool' ) ) ) ;?></h1>
                            <p class="ct_slider_text"><?php echo esc_html(get_theme_mod( 'homepage_banner_text',__( 'No fancy effects or unnecessary markup.', 'acool' )) );?></p>
                            <a class="btn" href="<?php echo esc_url(get_theme_mod( 'homepage_banner_button_url','#') );?>">
                                <?php echo esc_html(get_theme_mod( 'homepage_banner_button_text',__( 'Download', 'acool' )) );?>
                            </a>                       
                        </div>
                    </div>
                </div>
            </div>
        </section>

<div id="ct_content" class="ct_acool_content">   

  
        <section id="section-id-580caf4c1638f" class="ct_section ct_section_post_list_2 " style=" background-color:rgba(255,255,255,1);-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;background-size:100% 100%;">
			<div class="container "> 
				<?php
					$homepage_post_list_h1 = esc_html(get_theme_mod( 'homepage_post_list_h1',__('Blog posts', 'acool')));					
					$homepage_post_list_text = esc_html(get_theme_mod('homepage_post_list_text', __('Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere.', 'acool')));						
				?>	
              <div class="ct_section_title">
                  <h2><?php echo $homepage_post_list_h1;?></h2>
                  <h3><?php echo $homepage_post_list_text;?></h3> 
              </div>
					
								
				<div class="row most">
                <?php 
					global $wpdb;//ignore_sticky_posts //caller_get_posts 3.1 del
					
					$post_list_num = get_theme_mod( 'homepage_post_list_num',6);
					$options_cat_id = get_theme_mod( 'post_list_cat','uncategorized');
									
                    query_posts( array( 
					'showposts' => $post_list_num ,//6
					'ignore_sticky_posts' => 1,
					//'category_name' => $post_list_cat,
					'category__in' => $options_cat_id,
					
					 ));
					 
                    if (have_posts()) :  while (have_posts()) : the_post();                             
                ?> 
                    <div class="col-xs-12 col-sm-4 ct_clear_margin_padding"> 
              			<div class="col-md-12  ct_clear_margin_padding">
                            <div id="post-3420" class="ct_vertical_column ct_clear_margin_padding">
                                <div class="ct_post_img">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php
                                            $exclude_id = get_the_ID();
                                            $thumb_array = acool_get_thumbnail($exclude_id);
                                    ?>
                                            <img src="<?php echo $thumb_array['fullpath'];?>" />
                                    
                                        <div class="meta">
                                            <span class="glyphicon glyphicon-search ct_search_icon" ></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>


						<div class="col-md-12">
                            <div class="ct_post_info">
                                <h3><?php the_title(); ?></h3>
                                <p class="post-meta-2"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> <?php the_time('M d, y');?></p>   
                                <?php the_excerpt();?>                   
                            </div>
                        </div>
                    </div><!--div class="ct_row ct_clear_margin_padding"-->
                <?php endwhile; endif; ?>                             
               
                </div>					
                
                <div class="ct_post_more">
                    <a href="<?php $post_list_link =  esc_url(get_theme_mod( 'homepage_blog_url',''));if($post_list_link == ''){echo esc_url(home_url('/')).'blog/'; }else{echo $post_list_link;} ?>" class="casems"><span>MORE</span><i></i></a>
                </div>
                
			</div>
		</section>                
	</div>

              
    </div>
<?php get_footer(); ?>