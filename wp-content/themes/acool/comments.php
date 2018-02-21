<?php
/**
 * The template for displaying Comments
 *
 */
 if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area ct_comments">
	<?php if ( have_comments() ) : ?>
        <div class="ct_border">    
        <h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Comment on &ldquo;%s&rdquo;', 'comments title', 'acool' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Comment on &ldquo;%2$s&rdquo;',
						'%1$s Comments on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'acool'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>            
            
        </h2>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
            <h1 class="acool-screen-reader-text"><?php _e( 'Comment navigation', 'acool' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '<- Older Comments', 'acool' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments ->', 'acool' ) ); ?></div>
        </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>
        
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size'=> 34,
                    'callback' => 'acool_better_comments',
                ) );
            ?>
        </ol><!-- .comment-list -->
        
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
            <h1 class="acool-screen-reader-text"><?php _e( 'Comment navigation', 'acool' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '<- Older Comments', 'acool' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments ->', 'acool' ) ); ?></div>
        </nav><!-- #comment-nav-below -->
        <?php endif; // Check for comment navigation. ?>
        
        <?php if ( ! comments_open() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'acool' ); ?></p>
        <?php endif; ?>
        </div>    
	<?php endif; // have_comments() ?>

    
 	<?php if ( comments_open() ) : ?>
        <div class="ct_border"> 
        <?php comment_form() ?>
        </div>
	<?php endif; ?>   
    
</div><!-- #comments -->