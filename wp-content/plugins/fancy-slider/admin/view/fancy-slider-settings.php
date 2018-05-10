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

/**
* function to creat basic section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_section_callback_basic(){
	$text = 'In this section,fancy Slider can be setting up with different mode ,which a specific action would be applied';
    esc_html_e( $text, 'fancy-slider' ); 
}

/**
* function to creat advanced section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_section_callback_advanced(){
    $text = 'In this section,fancy Slider can be setting up with different selective components,with all of which a specific action would be applied';
    esc_html_e( $text, 'fancy-slider' ); 
}

/**
* function to creat general select field *
*@since 0.1.0
*@var function
*@return void
*@param $key -- the key of fancy_slider_options array
*       $elements -- the available values stored in array to a specific key above
*       $name  --  the part name of options displayed in fields
**/
function fancy_slider_select_field_callback($key,$elements,$name){
    $options = get_option( 'fancy_slider_options' );
    $mode_type = empty( $options[$key] ) ? '': esc_attr( $options[$key] );
    echo "<select name='fancy_slider_options[$key]'>";
            foreach ( $elements as $element ) { 
                $selected = selected( $mode_type , $element,false );
                if ($name[1]){
                    $suffix = $element === 'one'? '' : 'S';
                }else{
                    $suffix = '';
                }               
                echo "<option value='$element' $selected>" . __( strtoupper( $element ) . $name[0] . $suffix,'fancy-slider') . "</option>";
         } 
    echo '</select>';
}

/**
* function to creat mode section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_mode(){
    $name = array(' MODE',false);
    $elements = array('responsive','sync','center','lazy loading');
    fancy_slider_select_field_callback('mode_type',$elements,$name );
}

/**
* function to creat slider quantity section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_sliders_qty(){ 
    $name = array(' ITEM',true);
    $elements = array( 'one','two','three','four','five','six' );
    fancy_slider_select_field_callback('slider_qty',$elements,$name);  
}

/**
* function to creat scroll quantity section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_scroll_qty(){
    $name = array(' SCROLL',true);
    $elements = array('one','two','three','four');
    fancy_slider_select_field_callback('scroll_qty',$elements,$name); 
}

/**
* function to creat autoplay section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_autoplay(){
    $name = array('',false);
    $elements =array('true','false');
    fancy_slider_select_field_callback('slider_ap',$elements,$name);   
}

/**
* function to creat fade section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_fade(){
    $name = array('',false);
    $elements =array('true','false');
    fancy_slider_select_field_callback('slider_fd',$elements,$name);   
}

/**
* function to creat dot indicator section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_dot(){
    $name = array('',false);
    $elements =array('true','false');
    fancy_slider_select_field_callback('slider_dot',$elements,$name);   
}

/**
* function to creat infinite loop section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_inf(){
    $name = array('',false);
    $elements =array('true','false');
    fancy_slider_select_field_callback('slider_inf',$elements,$name);   
}

/**
* function to creat transition speed text callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_trans_spd(){
    $options = get_option( 'fancy_slider_options' );
    $trans_spd = esc_attr( $options['trans_spd'] );
    echo "<input type ='text' name='fancy_slider_options[trans_spd]' value='$trans_spd'>";
}

/**
* function to creat autoplay text callback *
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_field_callback_ap_spd(){
    $options = get_option( 'fancy_slider_options' );
    $ap_spd = esc_attr( $options['ap_spd'] );
    echo "<input type ='text' name='fancy_slider_options[ap_spd]' value='$ap_spd'>";
}


/**
* function to sanitize fancy_slider_options before inputing into database *
*@since 0.1.0
*@var function
*@return void
**/
function sanitize_options($input){
    $new        = array();
    $mode_type  = array( 'responsive','sync','center','lazy loading' );
    $slider_qty = array( 'one','two','three','four','five','six' );
    $scroll_qty = array( 'one','two','three','four' );
    $slider_ap  = array( 'true','false' );
    $slider_fd  = array( 'true','false' );
    $slider_dot = array( 'true','false' );  
    $slider_inf = array( 'true','false' );   
    $d_keys     = array( 'ap_spd','trans_spd' );
    $default    = 1000;
    /* key as fancy_slider_options[key] , value as a set of values, which is whitelist related to the key */
    $options    = array('mode_type'  => $mode_type ,
                        'slider_qty' => $slider_qty ,
                        'scroll_qty' => $scroll_qty,
                        'slider_ap'  => $slider_ap,
                        'slider_fd'  => $slider_fd,
                        'slider_dot' => $slider_dot,
                        'slider_inf' => $slider_inf
                    );
    /* sanitize string selection : whitelist and wp sanitize function */
    foreach ($options  as $key => $value ) {
        if ( isset($input[$key]) ){
           if ( in_array( $input[$key], $value) ){
               $new[$key] = sanitize_text_field( $input[$key] ); 
           }else{
               $new[$option] = null;
           }
        }else{
            $new[$option] = null;
        }
    }

    /* sanitize digital input text */
    foreach ($d_keys as $d_key) {
        if ( isset($input[$d_key]) ){
            if( preg_match("/^\d+\d+$|^\d$/", $input[$d_key]) ){
                $new[$d_key] = (int)$input[$d_key];
            }else {
                $new[$d_key] = $default;
            }
        }else{
            $input[$d_key] = null;
        }
    }

    return $new;
}