<?php

if(! function_exists('storefront_child_toolbar_wrapper')){
	/**
	* Display the header toolbar wrapper
	* create by hai
	* return void
	*/
	function storefront_child_toolbar_wrapper(){
		if(! wp_is_mobile()){
			 echo '<div class="site-header-tool">';
		}
		
	}
}

if(! function_exists('storefront_child_toolbar_wrapper_close')){
	/**
	* Display the header toolbar wrapper
	* create by hai
	* return void
	*/
	function storefront_child_toolbar_wrapper_close(){
		if(! wp_is_mobile()){
			echo '</div>';
		}
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
if ( ! function_exists('storefront_child_mobile_entry')) {
	/**
	* display mobile navi icon
	* @return void
	*/
	function storefront_child_mobile_entry(){
		if (wp_is_mobile()) { ?>
		    <div class="mobile-icon">
			    <?php
				$entries = array(
					'myaccount'=>'storefront_child_wc_account',
					'cart'=>'storefront_child_wc_cart',
					// 'wishlist'=>'storefront_child_wc_wishlist'			
				);
				foreach ($entries as $key => $value) {
					if(wc_get_page_id($key) != -1){
						$link =esc_url( get_permalink( wc_get_page_id($key) ));
						echo '<li>';
						call_user_func($entries[$key],$link);
						echo '</li>';
					}
				}
		        ?>
		    </div>
	    <?php }
	}
}

if( ! function_exists('storefront_child_wc_account')) {
	/**
	* display mobile wc_account
	* @return void
	*/
	function storefront_child_wc_account($link) { ?>
		<a class="mobile-account" href="<?php echo $link;?>">
			<i class="icon-user"></i>
		</a>
	<?php }
}

if( ! function_exists('storefront_child_wc_cart')) {
	/**
	* display mobile wc_cart
	* @return void
	*/
	function storefront_child_wc_cart($link) {
		?>
		<a class="mobile-cart" href="<?php echo $link;?>">
			<i class="icon-shopping-basket">
				<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
			</i>
		</a>
	<?php }
}

if( ! function_exists('storefront_child_wc_wishlist')) {
	/**
	* display mobile wc_wishlist
	* not available now
	* @return void
	*/
	function storefront_child_wc_wishlist($link) { ?>
		<a class="mobile-wishlist" href="<?php echo $link;?>">
			<i class="icon-heart"></i>
		</a>
	<?php }
}

if( ! function_exists('storefront_child_wc_search')) {
	/**
	* display mobile wc_search
	* @return void
	*/
	function storefront_child_wc_search() {
	    if ( storefront_is_woocommerce_activated() ) { ?>
			<div class="mobile-site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

if( ! function_exists('storefront_child_flexbox_open')) {

    function storefront_child_flexbox_open() {
        echo '<div class ="flexbox">';
    }
}

if( ! function_exists('storefront_child_flexbox_close')) {

	function storefront_child_flexbox_close() {
    	echo '</div>';
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
		<div class="storefront-primary-navigation">
			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'Storefront-Child' ); ?>">
			<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'Storefront-Child' ) ) ); ?></span></button>
				<?php if (wp_is_mobile()) {
				    
					wp_nav_menu(
						array(
							'theme_location'	=> 'handheld',
							'container_class'	=> 'handheld-navigation',
						)
					);
			    } else {
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
			    }
				?>
				
			</nav><!-- #site-navigation -->
		</div>
		<?php
	}
}
