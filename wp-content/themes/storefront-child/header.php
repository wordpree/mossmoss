<?php
/**
 * the header of storefront child theme.
 *
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>

<?php do_action( 'storefront_child_before_site' ); ?>
<div id="page" class="hfeed site slide-out">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
		<div class="site-header-container">
		    	<?php
				do_action('storefront_child_header_tool');
				?>

			<?php
			/**
			 * Functions hooked into storefront_header action
			 * child theme can be customized here within specific callback functions
			 * @hooked storefront_skip_links                       - 0
			 * @hooked storefront_social_icons                     - 10 none hooks found
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40 hooks in woocommerce
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60 hooks in woocommerce
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */
			do_action( 'storefront_child_header' ); ?>

		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); 
	?>

	<div id="content" class="site-content" tabindex="-1">
	<?php if(!is_front_page()):?>
		<div class="col-full">
    <?php endif;?>
		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );
