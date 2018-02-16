<?php
if(! function_exists('storefront_child_svg_insert')){
	/*
	* insert icons as inline svgs
	* create by Hai
	* return void
	*/
	function storefront_child_svg_insert(){ ?>
       <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
					<symbol id="icon-home2" viewBox="0 0 32 32">
						<title>home2</title>
						<path d="M16 1l-16 16 3 3 3-3v13h8v-6h4v6h8v-13l3 3 3-3-16-16zM16 14c-1.105 0-2-0.895-2-2s0.895-2 2-2c1.105 0 2 0.895 2 2s-0.895 2-2 2z"></path>
					</symbol>
					<symbol id="icon-office" viewBox="0 0 32 32">
						<title>office</title>
						<path d="M0 32h16v-32h-16v32zM10 4h4v4h-4v-4zM10 12h4v4h-4v-4zM10 20h4v4h-4v-4zM2 4h4v4h-4v-4zM2 12h4v4h-4v-4zM2 20h4v4h-4v-4zM18 10h14v2h-14zM18 32h4v-8h6v8h4v-18h-14z"></path>
					</symbol>
					<symbol id="icon-cart" viewBox="0 0 32 32">
						<title>cart</title>
						<path d="M12 29c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
						<path d="M32 29c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
						<path d="M32 16v-12h-24c0-1.105-0.895-2-2-2h-6v2h4l1.502 12.877c-0.915 0.733-1.502 1.859-1.502 3.123 0 2.209 1.791 4 4 4h24v-2h-24c-1.105 0-2-0.895-2-2 0-0.007 0-0.014 0-0.020l26-3.98z"></path>
					</symbol>
					<symbol id="icon-user-tie" viewBox="0 0 32 32">
						<title>user-tie</title>
						<path d="M10 6c0-3.314 2.686-6 6-6s6 2.686 6 6c0 3.314-2.686 6-6 6s-6-2.686-6-6zM24.002 14h-1.107l-6.222 12.633 2.327-11.633-3-3-3 3 2.327 11.633-6.222-12.633h-1.107c-3.998 0-3.998 2.687-3.998 6v10h24v-10c0-3.313 0-6-3.998-6z"></path>
					</symbol>
					<symbol id="icon-heart" viewBox="0 0 32 32">
						<title>heart</title>
						<path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
					</symbol>
				</defs>
	   </svg>
	<?php }
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

if ( ! function_exists( 'storefront_child_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_child_site_branding() {
		?>
		<div class="site-branding">
			<?php storefront_site_title_or_logo(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'storefront_child_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_child_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'Storefront-Child' ); ?>">
		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'Storefront-Child' ) ) ); ?></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'	=> 'left',
					'container_class'	=> 'primary-navigation-left',
					)
			);

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
