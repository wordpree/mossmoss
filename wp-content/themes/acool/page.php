<?php			
get_header(); ?>   

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
            
        <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
        	
        	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="ct_border">
                    <h1 class="ct_title_h1"><?php the_title(); ?></h1>
					<?php 
                        $hide_post_meta = get_theme_mod('hide_post_meta',0 ); 
                        if(!$hide_post_meta ){ acool_show_post_meta();}
                    ?> 
            
                    <?php the_content(); ?>
                	<p class="ct_clear"></p> 
                </div>
      
				<?php if(has_tag()){?>
                    <div class="ct_border">
                        <div id="article-tag">
                        <?php the_tags('<strong>'.__( 'Tags: ', 'acool' ).'</strong> ', ' , ' , ''); ?>
                        </div> 
                    </div>    
                        
                <?php }?>    
    
               	<?php
					$args = array (
						'before'            => '<div class="page-links-XXX"><span class="page-link-text">' . __( 'More pages: ', 'acool' ) . '</span>',
						'after'             => '</div>',
						'link_before'       => '<span class="page-link">',
						'link_after'        => '</span>',
						'next_or_number'    => 'number',
						'separator'         => ' | ',
						'nextpagelink'      => __( 'Next &raquo', 'acool' ),
						'previouspagelink'  => __( '&laquo Previous', 'acool' ),
					);
					 
					wp_link_pages( $args );
				?>

                <?php
					if ( comments_open() ){ 
						comments_template();
					}
                ?>
             
             </div>  
        <?php endwhile;endif; ?> 
        </div>

        <?php get_sidebar(); ?>
          
	</div></div> 		      
</div>

<?php get_footer(); ?>