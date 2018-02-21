<?php
function acool_better_comments($comment, $args, $depth)
{
	//$GLOBALS['comment'] = $comment;
?>	
 
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment_avatar">
                <?php echo get_avatar($comment, '',''); ?>
            </div>

            <div class="comment_postinfo">
                <?php printf(__('<cite class="fn">%s</cite> <span class="says"> on </span>','acool'), esc_url(get_comment_author_link())) ?>
                <span class="comment_date"><?php printf(__('%1$s at %2$s','acool'), get_comment_date(),  get_comment_time()) ?></span><?php edit_comment_link(__('(Edit)','acool'),'  ','') ?>
            </div> <!-- .comment_postinfo -->

            <div class="comment_area">				
                <div class="comment-content clearfix">
                	<?php if ($comment->comment_approved == '0') : ?>
                     	<em><?php _e('Your comment is awaiting moderation.','acool') ?></em>
                     	<br />
                    <?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    
                    <div class="reply-container">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                      
                </div> <!-- end comment-content-->
            </div> <!-- end comment_area-->
        </article> <!-- .comment-body -->
        
<?php
}


//add page number
function acool_paging_nav(){
	global $wp_query;
	$pages = $wp_query->max_num_pages; 
	if ( $pages >= 2 ): 
		$big = 999999999; 
		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'end_size' => 13, 
			'type' => 'array' 
			));
		echo '<div class="ct_page_nav"><ul class="pagination">';
		foreach ($paginate as $value)
		{
			echo '<li>'.$value.'</li>';
		}
		echo '</ul></div>';
	endif;
}

//header add mobile_nav
function acool_add_mobile_navigation(){
	printf(
		'<div id="ct_mobile_nav_menu">
			<a href="#" class="mobile_nav closed">
				<span class="select_page">%1$s</span>
				<span class="mobile_menu_bar"></span>
			</a>
		</div>',
		esc_html__( 'Select Page', 'acool' )
	);
}
add_action( 'ct_header_top', 'acool_add_mobile_navigation' );



/**
 * Convert Hex Code to RGB   #FFFFFF -> 255 255 255
 * @param  string $hex Color Hex Code
 * @return array       RGB values
 */
function acool_hex2rgb( $hex )
{
	if ( strpos( $hex,'rgb' ) !== FALSE )
	{
		$rgb_part = strstr( $hex, '(' );
		$rgb_part = trim($rgb_part, '(' );
		$rgb_part = rtrim($rgb_part, ')' );
		$rgb_part = explode( ',', $rgb_part );
		
		$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);
		
	}
	elseif( $hex == 'transparent' )
	{
		$rgb = array( '255', '255', '255', '0' );
	}
	else
	{
		$hex = str_replace( '#', '', $hex );	
		if( strlen( $hex ) == 3 )
		{
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		}
		else
		{
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
	}

	return $rgb; // returns an array with the rgb values
}



/* this function gets thumbnail from Post Thumbnail or Custom field or First post image */
if ( ! function_exists( 'acool_get_thumbnail' ) ) {
	function acool_get_thumbnail($post_id)
	{
		//if ( $post == '' ) global $post;
		if(has_post_thumbnail())
		{
			$ct_post_thumbnail_fullpath=wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "Full");
			$thumb_array['fullpath'] = esc_url($ct_post_thumbnail_fullpath[0]);
		
		}else{
			$post_content = get_post($post_id)->post_content;
			$thumb_array['fullpath'] = acool_catch_that_image($post_content);
		}
		
		
		if($post = 'front-page' && $thumb_array['fullpath']=="" )
		{			
			$thumb_array['fullpath'] = esc_url(get_template_directory_uri()."/images/default-thumbnail.jpg");
		}		

		return $thumb_array;		
	}
}

function acool_catch_that_image($post_content)
{
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
  if($output!='')  $first_img = $matches[1][0];

  return $first_img;
}

function acool_get_title($str,$limit) {
    if(strlen($str) > $limit) {
        $str = substr($str, 0, $limit);
    }
    echo $str;
}


//post_meta
function acool_show_post_meta()
{
?>
    <div class="ct_entry_meta">
        <span><i class="fa fa-clock-o"></i><a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m')));?>"><?php echo esc_html(get_the_date("M d, Y"));?></a></span>
        <span><i class="fa fa-user"></i><?php echo get_the_author_link(); ?></span> 
        <span><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
        <?php edit_post_link( __('Edit','acool'), '<span><i class="fa fa-pencil"></i>', '</span>', get_the_ID() ); ?>         
    </div>
 <?php
}

function acool_login_li() 
{
	
	if(is_user_logged_in())
	{
		?>
		<li><a href="<?php echo esc_url(home_url('/wp-admin/profile.php')); ?>"><?php _e('Profile','acool')?></a></li>  
		<?php		
	}
	else
	{
		?>
		<li><a href="<?php echo esc_url(wp_login_url());?>"><?php _e('Login','acool')?></a></li>  
		<?php
	}
}
