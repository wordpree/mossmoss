<?php
if(!function_exists('storefront_child_mini_navigation')){
	/*display mini naviagtion
	 *create by Hai
	 *return void
	*/
	function storefront_child_mini_navigation(){
		
		   echo '<div class="nimi-btn menu-toggle">';
		    echo '<button>Menu</button>';
		   echo '</div>';
			   wp_nav_menu(
					array(
						'theme_location'	=> 'mini',
						'container_class'	=> 'mini-navigation',
						)
				);		  
	}
}

if(! function_exists('storefront_child_toolbar_wrapper')){
	/**
	* Display the header toolbar wrapper
	* create by hai
	* return void
	*/
	function storefront_child_toolbar_wrapper(){
		echo '<div class="site-header-tool">';
	}
}

if(! function_exists('storefront_child_toolbar_wrapper_close')){
	/**
	* Display the header toolbar wrapper
	* create by hai
	* return void
	*/
	function storefront_child_toolbar_wrapper_close(){
		echo '</div>';
	}
}

if ( ! function_exists( 'storefront_child_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_child_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
			<br /> <?php printf( esc_attr__( '%1$s designed by %2$s.', 'storefront' ), 'Storefront Child Theme', '<a href="https://www.mossmoss.com.au" title="Child Theme - Specialized in" rel="author">Hai</a>' ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'storefront_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_child_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'left',
					'container_class'	=> 'primary-navigation-left',
					)
			);
		    storefront_site_branding();
            wp_nav_menu(
				array(
					'theme_location'	=> 'right',
					'container_class'	=> 'primary-navigation-right',
					)
			);
			wp_nav_menu(
				array(
					'theme_location'	=> 'handheld',
					'container_class'	=> 'handheld-navigation',
					)
			);
		    
			?>
			
		</nav><!-- #site-navigation -->
		<?php
	}
}
