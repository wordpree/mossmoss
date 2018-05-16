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
function fs_option_page_callback(){ ?>
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
function fs_section_callback_basic(){
	$text = 'In this section,fancy Slider can be setting up with different mode ,which a specific action would be applied';
    esc_html_e( $text, 'fancy-slider' ); 
}

/**
* function to creat advanced section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fs_section_callback_advanced(){
    $text = 'In this section,fancy Slider can be setting up with different selective components,with all of which a specific action would be applied';
    esc_html_e( $text, 'fancy-slider' ); 
}

/**
* function to creat default fancy_slider_options if achieve failed*
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_default_opts(){
    return array(
            'fs_std_no'=> array(
                'sli_qty' => '1',
                'scr_qty' => '1',
                'ap_spd'  => '3000',
                'trs_spd' => '300'
            ),
            'fs_std_slt'=>array(
                 'ap'  => 'false',
                 'fd'  => 'false',
                 'dot' => 'false',
                 'inf' => 'false'
            )                                         
    );
}

/**
* function to creat text field display*
*@since 0.1.0
*@var function
*@return void
*@param $id (string),  key of array fancy_slider_options
*       $key (string), key of array fancy_slider_options[$id] if it is a array
*       $label (string), label
**/
function fs_text_field($id,$key,$label){

    $options = get_option( 'fancy_slider_options' ,fancy_slider_default_opts());
    $name = "fancy_slider_options[$id]";
    if ( is_array($options[$id]) ){
        $options= &$options[$id];
        $name = "fancy_slider_options[$id][$key]";
        $id = $key;
    }
    $value = isset($options[$id] ) ?  $options[$id] : '';
    echo "<label for='$name'>$label</label>";
    echo "<input type ='text' id= '$name' name= '$name' value= '$value' size=6>";
}


/**
* function to creat number field display*
*@since 0.1.0
*@var function
*@return void
*@param $id (string),  key of array fancy_slider_options
*       $key (string), key of array fancy_slider_options[$id] if it is a array
*       $label (string), label
**/
function fs_number_field($id,$key,$label){
    $options = get_option( 'fancy_slider_options',fancy_slider_default_opts() );
    $name = "fancy_slider_options[$id]";
    if ( is_array($options[$id]) ){
        $options= &$options[$id];
        $name = "fancy_slider_options[$id][$key]";
        $id = $key;
    }
    $value = isset($options[$id] ) ?  $options[$id] : '';
    echo "<label for='$name'>$label</label>";
    echo "<input type ='number' id= '$name' name= '$name' value= '$value' >";
}

/**
* function to creat select field display*
*@since 0.1.0
*@var function
*@return void
*@param $id (string),  key of array fancy_slider_options
*       $key (string), key of array fancy_slider_options[$id] if it is a array
*       $label (string), label
**/
function fs_select_field($id,$key,$label){

    $options = get_option( 'fancy_slider_options',fancy_slider_default_opts() );
    $name = "fancy_slider_options[$id]";
    $elements =array('true','false');
    /*the $key is a array*/
    if ( is_array($options[$id]) ) {
        $options= &$options[$id];
        $name = "fancy_slider_options[$id][$key]";
        $id = $key;
    }
    $value  = isset( $options[$id] ) ? $options[$id] : '';
    echo "<label for='$name'>$label</label>";  
    echo "<select name='$name' id='$name'>";
            foreach ( $elements as $element ) { 
                $selected = selected( $value , $element,false );        
                echo "<option value='$element' $selected>" . __( $element ,'fancy-slider') . "</option>";
         } 
    echo '</select>';
}


/**
* text field callback function *
*@since 0.1.0
*@var function
*@return void
*@param $args (array), args in add_settings _field 
**/
function fs_field_callback_text($args){
    $id = isset($args['id'])? $args['id'] : '';
    $labels = empty($args['label_for'])?  '' : $args['label_for'];
    foreach ($labels as $key => $value) {
        fs_text_field($id,$key,$value );
    }

}

/**
* number field callback function *
*@since 0.1.0
*@var function
*@return void
*@param $args (array), args in add_settings _field 
**/
function fs_field_callback_number($args){
    $id = isset($args['id'])? $args['id'] : '';
    $labels = empty($args['label'])?  '' : $args['label'];
    echo '<fieldset>';
    foreach ($labels as $key => $value) {
        echo '<ul>';
        fs_number_field($id,$key,$value );
        echo '</ul>';
    }
    echo '</fieldset>';
}

/**
* select field callback function *
*@since 0.1.0
*@var function
*@return void
*@param $args (array), args in add_settings _field 
**/
function fs_field_callback_select($args){
    $id = isset($args['id'])? $args['id'] : '';
    $labels = empty($args['label'])?  '' : $args['label'];
    echo '<fieldset>';
    foreach ($labels as $key => $value) {
        echo '<ul>';
        fs_select_field($id,$key,$value );
        echo '</ul>';
    }
    echo '</fieldset>';
}


/**
* function to creat digital sanitize *
*@since 0.1.0
*@var function
*@param (string) $d_value 
*@return void
**/
function fs_sanitize_digital($d_value){  
        if ( isset($d_value) ){
            return preg_match("/^\d+\d+$|^\d$/", $d_value) ? true : false;    
        }else{
            return false;
        }    
}

/**
* function to creat boolean sanitize *
*@since 0.1.0
*@var function
*@param (string) $b_value
*@return void
**/
function fs_sanitize_bool($b_value){
    if ( ! isset($b_value) ){
        return false;
    }
    if ($b_value === 'false' || $b_value === 'true'){
        return true;
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
function fs_sanitize_options($input){  
    $new        = array();
    /* options whitelist */ 
    $options    = array(
        'fs_std_slt' => array( 'ap','fd','dot','inf' ),
        'fs_std_no' => array( 'sli_qty','scr_qty','ap_spd','trs_spd'),
    );
    foreach ($options  as $option => $array ) {
        if ( ! empty( $array ) ){
            foreach ($array as $value ) {
                $temp_value = isset( $input[$option][$value]) ? $input[$option][$value] : null;
                switch ( $option ) {
                    case 'fs_std_slt':
                        $new[$option][$value] = fs_sanitize_bool($temp_value) ? $temp_value : fancy_slider_default_opts()[$option][$value];
                        break;
                    
                    case 'fs_std_no':
                        $new[$option][$value] =  fs_sanitize_digital($temp_value) ? $temp_value : fancy_slider_default_opts()[$option][$value];
                        break;
                }    
            }  
        }           
    }
    return $new;
}