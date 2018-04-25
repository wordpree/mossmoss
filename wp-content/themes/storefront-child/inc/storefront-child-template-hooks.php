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


add_action( 'storefront_child_header', 'storefront_skip_links',                                      0 );
// add_action( 'storefront_child_header', 'storefront_secondary_navigation',                            30 );


if ( $storefront_child_is_woocommerce_actived ) {
  switch (multiDeviceCheck()) {
  	case 'mobile':
  	add_action( 'storefront_child_header', 'storefront_child_flexbox_open',                      29 );
		add_action( 'storefront_child_header', 'storefront_child_site_branding',                     30 );
		add_action( 'storefront_child_header', 'storefront_child_mobile_entry',                      31 );
		add_action( 'storefront_child_header', 'storefront_child_flexbox_close',                     32 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper',        49 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_mini_menu',      50 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_handheld',       51 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper_close',  69 );
  	break;
  	case 'tablet':
    add_action( 'storefront_child_header', 'storefront_child_site_branding',                     30 );
    add_action( 'storefront_child_header', 'storefront_child_wc_search',                         31 );
    add_action( 'storefront_child_header', 'storefront_child_flexbox_open',                      35 );
    add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper',        36 );
    add_action( 'storefront_child_header', 'storefront_child_primary_navigation_mini_menu',      37 );
    add_action( 'storefront_child_header', 'storefront_child_primary_navigation_handheld',       38 );
    add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper_close',  39 );
    add_action( 'storefront_child_header', 'storefront_child_mobile_entry',                      40 );
    add_action( 'storefront_child_header', 'storefront_child_flexbox_close',                     60 );
  	break;
  	case 'desktop':
  	add_action( 'storefront_child_header_tool', 'storefront_child_toolbar_wrapper',              32 );
		add_action( 'storefront_child_header_tool', 'storefront_product_search',                     40 );
		add_action( 'storefront_child_header_tool', 'storefront_header_cart',                        41 );
		add_action( 'storefront_child_header_tool', 'storefront_child_toolbar_wrapper_close',        42 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper',        49 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_mini_menu',      50 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_handheld',       51 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_left',           52 );
		add_action( 'storefront_child_header', 'storefront_child_site_branding',                     53 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_right',          54 );
		add_action( 'storefront_child_header', 'storefront_child_primary_navigation_wrapper_close',  69 );
  	break;
  }
}else{

}

add_action( 'storefront_child_before_content', 'storefront_child_header_widget_region', 10 );
/**
 * Storefront Footer
 * @see  storefront_credit()
 */
add_action( 'storefront_child_footer', 'storefront_child_credit',   20 );
add_action( 'storefront_child_footer', 'storefront_footer_widgets', 10 );