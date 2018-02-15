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
*  @see storefront_skip_links()
*  add_action( 'storefront_child_header', 'storefront_skip_links',                       0 );

/* put the site brading in the middle of the homepage nav 
*  @see storefront_child_primary_navigation
*  add_action( 'storefront_child_header', 'storefront_site_branding',                    20 );
*/
add_action( 'storefront_child_header_tool', 'storefront_child_toolbar_wrapper',         32 );
add_action( 'storefront_child_header_tool', 'storefront_child_toolbar_wrapper_close',   42 );
add_action( 'storefront_child_header', 'storefront_secondary_navigation',               30 );
add_action( 'storefront_child_header', 'storefront_primary_navigation_wrapper',         42 );
add_action( 'storefront_child_header', 'storefront_child_primary_navigation',           50 );
add_action( 'storefront_child_header', 'storefront_primary_navigation_wrapper_close',   68 );
add_action('storefront_child_before_site','storefront_child_svg_insert',                20);

/**
* wooecommerce header
* @see storefront_product_search()
* @see storefront_header_cart()

**/
if ( $storefront_child_is_woocommerce_actived ) {
	add_action( 'storefront_child_header_tool', 'storefront_product_search',               40 );
	/*don't show this in the homepage */
	 add_action( 'storefront_child_header_tool', 'storefront_header_cart',                 41 );
   
}

/**
 * Storefront Footer
 * @see  storefront_credit()
 */
add_action( 'storefront_child_footer', 'storefront_child_credit',   20 );
add_action( 'storefront_child_footer', 'storefront_footer_widgets', 10 );