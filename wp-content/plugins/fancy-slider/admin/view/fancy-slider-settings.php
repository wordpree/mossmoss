<?php 

/**
 * Fancy slider plugin admin settings callback functions are listed here
 *
 * @since      0.1.0
 * @package    fancy_slider
 * @subpackage fancy_slider/admin/view
 */

if ( ! ( defined('ABSPATH') ) ){
	die('sorry! you cannot access directly');
}

/**
* add_options_page callback function,the function to be called to output the content for this page. 
*@since 0.1.0
*@var function
*@return void
*/
function fancy_slider_option_page_callback(){ ?>
    <div class="wrap">
        <form action="options.php" method="POST">
            <?php settings_fields( 'fancy_slider_option_gp' ); ?>
            <?php do_settings_sections( 'fancy-slider' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
<?php }

function fancy_slider_section_callback_mode(){
    echo 'This is section mode';
}
function fancy_slider_section_callback_advanced(){
   echo 'This is section advanced';
}
function fancy_slider_field_callback_single(){
    echo 'this is single mode';
}
function fancy_slider_field_callback_multiple(){
    echo 'this is multiple mode';
}
function fancy_slider_field_callback_center(){
    echo 'this is center mode';
}
function fancy_slider_field_callback_responsive(){
    echo 'this is responsive mode';
}
function fancy_slider_field_callback_fade(){
    echo 'this is fade mode';
}
function fancy_slider_field_callback_sync(){
    echo 'this is sync mode';
}
function fancy_slider_field_callback_atribute(){
    echo 'this is atribute mode';
}