<?php
  /*===============================================
  require       :header.php && footer.php
  Description   :storefront child theme frontpage
  author        :Hai
  create time   :06/2017
  content       :1---sliders
                 2---featured product
				 3---testimonials
				 4---brief introduction
				 5---recent posts
				 6---social links
	All CPT here can be instead of post type ,which is via appearance settings
  =================================================*/


require 'header.php';
?>
<!--header sliders start here -->
<?php
	$args =array(
	  'post_type'=>'yee_slider',
	  'oderby'=>'rand',
	  'posts_per_page'=>-1
	);
	$query =new WP_Query($args);
?>
<section id="header-sliders-section" class="header-sliders-section">
<?php
	if($query->have_posts()){
		echo '<div class="header-slider-wrapper fancy-panel-wrapper">';
		while($query->have_posts()){
			$query->the_post();
			if(has_post_thumbnail()):
				$img_id =get_post_thumbnail_id();
				$image =wp_get_attachment_url($img_id);    
			    ?>
			    <div class="fancy-panel">
					<div id='image-<?php echo $img_id;?>' class="featured-image slider-bg-img" style='background-image:url("<?php  echo $image;?>");'></div>
					<div class="slider-caption header-slider-caption">
						<h2><?php the_title();?></h2>
						<?php the_content();?>
					</div>
	            </div>
			    <?php
			endif;
	
		}
		echo '</div>';
	}
	wp_reset_postdata();
?>
</section>
<!--featured product posts start here -->
<div id="products" class="featured-products">
  <div class="products-heading">
	    <h2>Featured Products Are Here</h2>
  </div>
  <div class="products-rows">
  <?php
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if (is_plugin_active( 'woocommerce/woocommerce.php' ) ) :
    //plugin is activated
	 $args =array(
	  'post_type'     =>'product',
	  'oderby'        =>'rand',
	  'posts_per_page'=>3,
      'tax_query' => array(
          array(
				'taxonomy' => 'product_cat',
			    'field'    => 'slug',
			    'terms'    => 'posters',
          )
       )
	);
 else:
	  $args =null;?>
	  <!--woocommerce plugin is deactivated -->
  <?php endif; 

	$query =new WP_Query($args);
	  if($query->have_posts()){
		  while($query->have_posts()){
			  $query->the_post();
			  if(has_post_thumbnail()) :
				  $img_id =get_post_thumbnail_id();
				  $image =wp_get_attachment_url($img_id);?> 
				  <div class=product-item-row>
				    <div class=product-item>
	                  <div class="featured-image" style="background-image:url('<?php echo $image;?>');"></div> 
				       <div class="caption">
					     <div class="item-permalink">
						   <a href='<?php the_permalink();?>'><button>Read More</button>;</a>
					     </div>
	                   </div>
	                   <div class='item-description'>
	                      <?php the_title('<h3>','</h3>');the_content('');?>
	                   </div>
	                 </div>
				  </div>
		      <?php endif;
	     }
   	
	 }
	wp_reset_postdata();
    ?>
	</div>
</div>
<!--testimonials start here -->
<?php
/*query the testimonials contents*/
	$args= array(
	'post_type'=>'yee_testimonial',
	'oderby'=>'rand',
	'posts_per_page'=>2
);
$query =new WP_Query($args);
?>
<section id="testimonials">
	<div id="testimonials-container" class="testimonials-container">
		<?php 
		if($query->have_posts()){
		   
		   while($query->have_posts()){
			   $query->the_post();
			   ?>
			   <div id ="testimonial-<?php the_id();?>" class="testimonial">
				 <?php 
			      echo '<div class="testimonials-caption"/>';
				    the_title('<h3>','</h3>');
			        the_content();
			      echo '</div>';
				  if ( has_post_thumbnail() ){
					  echo '<div class="testimonials-img">';
					    the_post_thumbnail('full');
					  echo '</div>';
				   } 
				  
			echo '</div>';	
		   }
           
		}
	echo '</div>';
echo '</section>';
wp_reset_postdata();
?>
<!--brief introduction starts here-->
<?php
$args =array(
      'post_type'=>'post',
	  'posts_per_page'=>3,
	  'tax_query'=>array(
	         array(
	            'taxonomy' => 'category',
			    'field'    => 'slug',
			    'terms'    => 'brief-info')
       )
);
$query =new WP_Query($args);
?>
<section id="brief-intro" class="brief-intro">
	<div class='section-title' style="background-image: url('<?php echo get_theme_mod('brief_info_background_image' ); ?>')"><h2>All About Us</h2></div>
	<div class='container'>
		<div class='row-container'>
		    <?php if($query->have_posts()){
	                 while($query->have_posts()){
						 $query->the_post();
						 echo "<div class='bi-row-container'>";
						  echo "<div class='bi-row'>";
						    echo "<i class='icomoon-fonts'></i>";
						    the_title('<h3>','</h3>');
						    the_content();
			              echo "</div>";
						 echo "</div>";
					 }
             }?>
		</div>
	</div>
</section>
<!--recent products start here -->
<section id="recent-posts-section" class="recent-posts-section">
	<div class="section-header"><h2>Latest Posts</h2><p>All out new products have been shown here and there would be one fit your favour.</p></div>
  <?php  if(is_plugin_active('woocommerce/woocommerce.php')): /*recent posts title and p need customizer settings later*/
	       $args=array(
	          'posts_per_page'=>6,
	          'orderby'=>'data',
	          'post_type'=>'product',
           );
	       else:?>
	       <!--woocommerce plugin is deactivated -->
	       <?php $args=null;
	       endif;
	 
	       $query =new WP_Query($args);
	       if($query->have_posts()){
			   echo '<div class="newly-products-wrapper fancy-panel-wrapper">';
			    
			     while($query->have_posts()){
				    echo '<div class="fancy-panel">';
			  	   $query->the_post(); 
			  	   if(has_post_thumbnail()){
			  		   $img =get_the_post_thumbnail_url();?>
			  		   <div class=" newly-post slider-bg-img" style='background-image:url("<?php echo $img;?>")'></div>
			  		   <div class="slider-caption post-caption">
			  		     <div class="post-date">
			  		   	   <span class="entry-date"><?php echo get_the_date('d-M-Y'); ?></span>
			  		     </div>
			  		     <?php the_title('<h3>','</h3>');the_content();?>
			  		   </div>
			  		   
			  	   <?php } 
				   echo '</div>';
			     }
			     
			   echo '</div>';
		   }
	       wp_reset_postdata();
		   
	?>
</section>
<!--social links start here -->

<?php 
	$social_media_title = get_theme_mod('social_media_title');			  
	$social_media_bg = get_theme_mod('social_media_bg');
	$social_media_twitter= esc_url(get_theme_mod('social_media_twitter'));
	$social_media_facebook= esc_url(get_theme_mod('social_media_facebook'));
	$social_media_youtube= esc_url(get_theme_mod('social_media_youtube'));			   
	$social_media_instagram = esc_url(get_theme_mod('social_media_instagram'));
	$social_media_google = esc_url(get_theme_mod('social_media_google'));
	$social_media_pinterest = esc_url(get_theme_mod('social_media_pinterest'));
	$social_media_linkedin = esc_url(get_theme_mod('social_media_linkedin'));
	$social_media_email = get_theme_mod('social_media_email');
	if($social_media_title || $social_media_bg  ||$social_media_twitter||$social_media_youtube||$social_media_instagram||$social_media_google||$social_media_pinterest||$social_media_linkedin||$social_media_email||$social_media_facebook):?>
	<section id='social-media' class='social-media'>
		<div class='media-container' style='background-image: url("<?php echo $social_media_bg;?>")'>
		   <?php if($social_media_title):?>
			       <h2><?php echo $social_media_title; ?></h2>
			<?php endif;
			     if($social_media_twitter):?>
			       <a href='<?php echo $social_media_twitter; ?>'><i class='icon-twitter icomoon-fonts'></i></a>
			<?php endif;
			     if($social_media_facebook):?>
			       <a href='<?php echo $social_media_facebook; ?>'><i class='icon-facebook icomoon-fonts'></i></a>
			<?php endif;
			     if($social_media_youtube):?>
			       <a href='<?php echo $social_media_youtube; ?>'><i class='icon-youtube icomoon-fonts'></i></a>
			<?php endif;
			     if($social_media_instagram):?>
					<a href='<?php echo $social_media_instagram; ?>'><i class='icon-instagram icomoon-fonts'></i></a>
			<?php endif;
			      if($social_media_google):?>
					<a href='<?php echo $social_media_google; ?>'><i class='icon-google-plus icomoon-fonts'></i></a>
			<?php endif;
			      if($social_media_pinterest):?>
					<a href='<?php echo $social_media_pinterest; ?>'><i class='icon-pinterest icomoon-fonts'></i></a>
			<?php endif;
			      if($social_media_linkedin):?>
					<a href='<?php echo $social_media_linkedin; ?>'><i class='icon-linkedin icomoon-fonts'></i></a>
			<?php endif;
			      if($social_media_email):?>
			        <a href='<?php echo $social_media_email; ?>'><i class='icon-mail icomoon-fonts'></i></a>
			<?php endif;
			?>
		</div>
	</section>
	<?php endif;
require 'footer.php';