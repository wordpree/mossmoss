<?php 
/**
 * Plugin Name: fancy slider
 * Plugin URI:  https://yijiang.com.au
 * Description: Easily slides your fonder
 * Version:     0.1.0
 * Author:      Hai
 * Author URI:  https://www.webite.me
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: fancy-slider
 * Domain Path: /languages
 * License:     GPL version 3
        * * * * * * * * * * * * * * * * * * * * *
    fancy slider is a wordpress plugin to slide your images
    Copyright (C) <2018>  <Hai Jun Wang>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
**/

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
require_once plugin_dir_path( __FILE__ )   . 'includes/class-fancy-slider.php';
require_once plugin_dir_path( __FILE__ )   . 'includes/widgets/class-fancy-slider-widget.php';
require_once plugin_dir_path( __FILE__ )   . 'admin/11.php';

define ('FANCY_SLIDER_VERSION','0.1.0');
define ('FANCY_SLIDER_NAME','fancy-slider');

$fancy_slider = new Fancy_Slider(FANCY_SLIDER_NAME,FANCY_SLIDER_VERSION);

/* activate or deactivate plugin */

register_activation_hook(   __FILE__, array( $fancy_slider ,'plugin_activator' ) );
register_deactivation_hook( __FILE__, array( $fancy_slider ,'plugin_deactivate') );

/* Hooks a function on to a specific action or filter action */
$fancy_slider ->plugin_add_action();
$fancy_slider ->plugin_add_filter();
