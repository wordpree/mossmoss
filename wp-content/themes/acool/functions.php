<?php
$template_directory = get_template_directory();
global $theme_info;

$theme_info = wp_get_theme();

require_once( $template_directory . '/includes/theme-setup.php' );

get_template_part('/includes/breadcrumb-trail');
require_once( $template_directory . '/includes/acool-config.php' );
get_template_part('/includes/customizer-pro/class-customize');

require_once( $template_directory . '/includes/widgets.php');
require_once( $template_directory . '/includes/custom-functions.php' );
require_once( $template_directory . '/includes/tgm-plugin.php' );
?>