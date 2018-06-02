<?php 
  /*
   * Plugin Name: Multiple Devices Detect
   * Plugin URI: 
   * Description: It is a plugin to detect the types of devices when visiting website and is based on a lightweight PHP class:Mobile_Detect 
   * Version: 1.0.0
   * Author: Hai Jun Wang
   * Author URI: https://www.webite.me
   * Text Domain: mdd
   * License: GPL3
   * License URI: https://www.gnu.org/licenses/gpl.html
   * Domain Path:
  */

?>

<?php 
if (! defined('ABSPATH')){	
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'inc/Mobile_Detect.php';


function multi_device_check(){
    $mobile_detect = new Mobile_Detect();
    $device_type =  $mobile_detect->isMobile() ? ( $mobile_detect->isTablet() ? 'tablet' : 'mobile' ) : 'desktop';
    return $device_type;
}
