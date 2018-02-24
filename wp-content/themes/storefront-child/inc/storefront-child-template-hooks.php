<?php
/** customized frontpage of storefront theme **/

 /* Storefront Header
 *
 * @see  storefront_skip_links()
 * @see  storefront_site_branding()
 * @see  storefront_secondary_navigation()
 * @see  storefront_primary_navigation_wrapper()
 * @see  storefront_primary_navigation()
 * @see  storefront_primary_navigation_wrapper_close()
 
 */

/* remove the skip link in the header 
*  remove storefront_primary_navigation_wrapper
*  remove storefront_primary_navigation_wrapper_close
*  @see storefront_skip_links()
*  add_action( 'storefront_child_header', 'storefront_skip_links',                       0 );
*/



add_action( 'storefront_child_header', 'storefront_secondary_navigation',                    30 );
add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper',        49 );
add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper_close',  69 );


/**
* wooecommerce header
**/
if ( $storefront_child_is_woocommerce_actived ) {

	if (wp_is_mobile()){
		add_action( 'storefront_child_header', 'storefront_child_flexbox_open',                 29 );
		add_action( 'storefront_child_header', 'storefront_child_site_branding',                30 );
		add_action( 'storefront_child_header', 'storefront_child_mobile_entry',                 31 );
		add_action( 'storefront_child_header', 'storefront_child_flexbox_close',                32 );
		add_action( 'storefront_child_header', 'storefront_child_flexbox_open',                 48 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_mini_menu', 50 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_handheld',  51 );
		add_action( 'storefront_child_header', 'storefront_child_wc_search',                    70 );
		add_action( 'storefront_child_header', 'storefront_child_flexbox_close',                71 );
	}else{
		add_action( 'storefront_child_header_tool', 'storefront_child_toolbar_wrapper',       32 );
		add_action( 'storefront_child_header_tool', 'storefront_product_search',              40 );
		add_action( 'storefront_child_header_tool', 'storefront_header_cart',                 41 );
		add_action( 'storefront_child_header_tool', 'storefront_child_toolbar_wrapper_close', 42 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_left',    52 );
		add_action( 'storefront_child_header', 'storefront_child_site_branding',              53 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_right',   54 );
	}	
}

/**
 * Storefront Footer
 * @see  storefront_credit()
 */
add_action( 'storefront_child_footer', 'storefront_child_credit',   20 );
add_action( 'storefront_child_footer', 'storefront_footer_widgets', 10 );