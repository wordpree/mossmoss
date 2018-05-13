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
* function to creat text section*
*@since 0.1.0
*@var function
*@return void
*@param $key -- string, $key in options
*       $elements -- array, a set of values in options
**/
function fancy_slider_text_field($key){
    $options = get_option( 'fancy_slider_options' );
    $name = "fancy_slider_options[$key]";
    if ($key === 'slider_ctr') {
        $options= &$options['slider_ctr'];
        $key = 'pad';
        $name = "fancy_slider_options[slider_ctr][pad]";
    }
    $value = isset($options[$key] ) ? esc_attr( $options[$key] ): '';
    echo "<input type ='text' name=$name value='$value' size=6>";
}

/**
* function to creat select section*
*@since 0.1.0
*@var function
*@return void
*@param $key -- string, $key in options
*       $elements -- array, a set of values in options
**/
function fancy_slider_select_field($key,$elements){
 
    $options = get_option( 'fancy_slider_options' );
    $name = "fancy_slider_options[$key]";
    /*the $key is a array*/
    if ($key === 'slider_ctr') {
        $options= &$options['slider_ctr'];
        $key = 'mode';
        $name = "fancy_slider_options[slider_ctr][mode]";
    }  
    $value  = empty( $options[$key] ) ? '': esc_attr( $options[$key] );
    echo "<select name=$name>";
            foreach ( $elements as $element ) { 
                $selected = selected( $value , $element,false );              
                echo "<option value='$element' $selected>" . __( strtoupper( $element ) ,'fancy-slider') . "</option>";
         } 
    echo '</select>';
}

/**
* function to creat center callback *
*@since 0.1.0
*@var function
*@return void
*@param $args -- array in callback function registered in  add_settings _field
**/
function fancy_slider_field_callback_center($args){
    $id = isset($args['id'])? $args['id'] : '';
    $elements = array('true','false');
    fancy_slider_select_field($id,$elements);
    fancy_slider_text_field($id);  
}

/**
* function to creat slider quantity section callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_sliders_qty($args){ 
    $id = isset($args['id'])? $args['id'] : '';
    $elements = array( 1,2,3,4,5,6);
    fancy_slider_select_field($id,$elements);
}

/**
* function to creat scroll quantity section callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_scroll_qty($args){
    $id = isset($args['id'])? $args['id'] : '';
    $elements = array(1,2,3,4);
    fancy_slider_select_field($id,$elements); 
}

/**
* function to creat autoplay section callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_autoplay($args){
    $id = isset($args['id'])? $args['id'] : '';
    $elements =array('true','false');
    fancy_slider_select_field($id,$elements);   
}

/**
* function to creat fade section callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_fade($args){
    $id = isset($args['id'])? $args['id'] : '';
    $elements =array('true','false');
    fancy_slider_select_field($id,$elements);   
}

/**
* function to creat dot indicator section callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_dot($args){
    $id = isset($args['id'])? $args['id'] : '';
    $elements =array('true','false');
    fancy_slider_select_field($id,$elements);    
}

/**
* function to creat infinite loop section callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_inf($args){
    $id = isset($args['id'])? $args['id'] : '';
    $elements =array('true','false');
    fancy_slider_select_field($id,$elements);    
}

/**
* function to creat transition speed text callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_trans_spd($args){
    $id = isset($args['id'])? $args['id'] : '';
    fancy_slider_text_field($id);
}

/**
* function to creat autoplay text callback *
*@since 0.1.0
*@var function
*@param $args -- array in callback function registered in  add_settings _field
*@return void
**/
function fancy_slider_field_callback_ap_spd($args){
    $id = isset($args['id'])? $args['id'] : '';
    fancy_slider_text_field($id);
}

function sanitize_digital($d_value){  
        if ( isset($d_value) ){
            return preg_match("/^\d+\d+$|^\d$/", $d_value) ? true : false;    
        }else{
            return false;
        }    
}
/**
* function to sanitize fancy_slider_options before inputing into database *
*@since 0.1.0
*@var function
*@return void
**/
function sanitize_options($input){  
    $new        = array();
    /* options whitelist */ 
    $options    = array('slider_ctr' => array( 'mode' => array('true','false'),'pad' => 50),
                        'slider_qty' => array( 1,2,3,4,5,6) ,
                        'scroll_qty' => array( 1,2,3,4),
                        'slider_ap'  => array( 'true','false' ),
                        'slider_fd'  => array( 'true','false' ),
                        'slider_dot' => array( 'true','false' ),
                        'slider_inf' => array( 'true','false' ),
                        'ap_spd'     => 3000,
                        'trans_spd'  => 300
                    );

    foreach ($options  as $option => $array ) {
        $value = isset( $input[$option] ) ? $input[$option] : null;
        /* array of option[key] */
        if ($option === 'slider_ctr' ){       
            /* select field whitelist sanitized */
            if ( in_array($input['slider_ctr']['mode'], $array['mode']) ){
                $new['slider_ctr']['mode'] = $input['slider_ctr']['mode']; 
            }else{
                $new['slider_ctr']['mode'] = null;
            }
            /* digital text field sanitized */
            if ( sanitize_digital( $input['slider_ctr']['pad'] ) ){
                $new['slider_ctr']['pad'] = (int)$input['slider_ctr']['pad']; 
            }else{
                $new['slider_ctr']['pad'] = $array['pad'] ;
            }
        }else{
            if( is_array($array) ){
                /* select field whitelist sanitized */
                $new[$option] = in_array( $value, $array ) ? $value : null;
            }else{
                /* digital text field sanitized */
                $new[$option] = sanitize_digital( $value ) ? (int)$value : (int)$array;
            }               
        }
        
    }
    return $new;
}