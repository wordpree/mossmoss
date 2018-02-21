<?php get_header(); ?>   

<div class="ct_single">

	<div class="container"><div class="row">

            <?php 
				if(get_theme_mod( 'enable_breadcrumb_check',1 ) ){  
			?>
        	<div class="container">
			<?php acool_breadcrumb_trail(); ?> 
            </div>
			<?php }?>        
        
    
        <div class="col-md-8 ct_single_content" > 
            <div class="ct_border">
                <h1 class="ct_title_h1"><?php esc_html_e('404 Page!','acool');?></h1>
    
                    <div class="text-center">
                        <img class="img-404" src="<?php echo esc_url(get_stylesheet_directory_uri());?>/images/404.png" alt="<?php  esc_attr_e('404 not found','acool')?>" />
                        <br/> <br/>
                        <a href="<?php echo esc_url(home_url('/'));?>"><i class="fa fa-home"></i> <?php  esc_html_e('Please, return to homepage!','acool')?></a>
                    </div>

            </div><!--div class="ct_border"-->
        </div><!--div class="col-md-8 ct_single_content" --> 
    
        <?php get_sidebar(); ?>
             
	</div></div><!--div class="container"><div class="row"--> 		      
</div><!--div class="ct_single"-->

<?php get_footer(); ?>