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
function fs_section_callback_basic($args){
    $settings = fs_settings_field();
    $html = '<p>' . $settings[ $args['id'] ]['brief'] . '</p>';
    _e( $html, 'fancy-slider' ); 
}


/**
* function to creat default fancy_slider_options if achieve failed*
*@since 0.1.0
*@var function
*@return void
**/
function fancy_slider_default_opts(){
    return array(
            'fs_std_number'=> array(
                'sli_qty' => '1',
                'scr_qty' => '1',
                'ap_spd'  => '3000',
                'trs_spd' => '300',
                'pad'     => '50',
            ),
            'fs_std_checkbox'=> 'arrow',
            'fs_md_radio' => 'slide'                                       
    );
}
function fs_sanitize_options($input){
    return $input;
}
function fs_fields_callback($args){

}
/**
* function to generate field settings *
*@since 0.1.0
*@var function
*@return settings array
**/
function fs_settings_field(){
    $settings['basic'] = array(
        'title'  => 'Slider Basic Settings',
        'brief'  => 'Slider basic settings are listed below',
        'page'   => 'fancy-slider',
        'scb'    => 'fs_sanitize_options',
        'fcb'    => 'fs_fields_callback',
        'opt'    => 'fancy_slider_options',
        'fields' => array(
            array(
                'id' => 'multi_checkbox_format',
                'sub_title' => 'Format Setting',
                'brief'     =>  'Please tick your slider format',
                'type'      => 'checkbox',
                'options'   => array(
                    'autoplay'  => 'Autoplay',
                    'dot'       => 'Dot Indicator',
                    'infinite'  => 'Infinite Loop',
                    'centre'    => 'Centre Mode',
                    'arrow'     => 'Next/Prev Arrows'
                )
            ),
            array(
                'id' => 'radio_mode',
                'sub_title' => 'Mode Selection',
                'brief'     =>  'Here,slider mode can be selected',
                'type'      => 'radio',
                'options'   => array(
                    'slide'  => 'Slide',
                    'fade'       => 'Fade'
                )
            ),
            array(
                'id' => 'number_digital',
                'sub_title' => 'Digital Parameter',
                'brief'     =>  'Please input your parameter here',
                'type'      =>  'number'
            )                 
        )
    );
    $settings = apply_filters( 'fancy_slider_settings', $settings );
    return $settings;
}

/**
* function to display $type input field display *
*@since 0.1.0
*@var function
*@return void
*@param $id (string),  key of array fancy_slider_options
*       $key (string), key of array fancy_slider_options[$id] if it is a array
*       $label (string), label
*       $type (string), input type
**/
function fs_text_field($id,$label){
    $options = get_option( 'fancy_slider_options',fancy_slider_default_opts() );
    $name = "fancy_slider_options[$id]";
    $value = $options[$id];
    switch ($id) {
        case 'fs_std_checkbox':
            // $options= &$options[$id];
            // foreach ($label as $key => $value) {
            //     $name = "fancy_slider_options[$id][$key]";
            // }
            foreach ($label as $key => $title) {
                $checked = checked($value,$key,false);
                $name = "fancy_slider_options[]";
                echo "<li>" . "<label>" .
                    "<input type ='checkbox' name='$name' value='$key' $checked >" . "$title" .
                 "</label></li>";
            }
            break;
        
        case 'fs_md_radio':
            foreach ($label as $key => $title) {
                $checked = checked($value,$key,false);
                echo "<li>" . "<label>" .
                    "<input type ='radio' name='$name' value='$key' $checked >" . "$title" .
                 "</label></li>";
            }
            break;
    }
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
* number field callback function *
*@since 0.1.0
*@var function
*@return void
*@param $args (array), args in add_settings _field 
**/
function fs_field_callback_text($args){
    $id = isset($args['id'])? $args['id'] : '';
    $label = empty($args['label'])?  '' : $args['label'];
    echo '<fieldset>' . '<ul>';
    fs_text_field($id,$label);
    echo '</ul>' . '</fieldset>';
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
function sanitize_options($input){  
    // $new        = array();
    // $options_array    = array(
        
    //     'fs_std_number'  => array( 'sli_qty','scr_qty','ap_spd','trs_spd','pad')
    // );
    // $options_single = array(
    //     'fs_md_radio' => array('slide','fade'),
    //     'fs_std_checkbox'=> array( 'autoplay','dot','infinite','centre' ,'arrow')
    // );
    // foreach ($options_array  as $option => $array ) {
    //     foreach ($array as $value ) {
    //         $temp_value = isset( $input[$option][$value]) ? $input[$option][$value] : null;
    //         switch ( $option ) {
    //             case 'fs_std_checkbox':
    //                 $new[$option][$value] = $temp_value ;
    //                 break;
                
    //             case 'fs_std_number':
    //                 $new[$option][$value] = fs_sanitize_digital($temp_value) ? $temp_value : fancy_slider_default_opts()[$option][$value];
    //                 break;
    //         }    
    //     }       
    // }

    // foreach ($options_single as $key => $value) {
    //     $new[$key] = isset( $input[$key] ) ? $input[$key]: null;
    //     $new[$key] = in_array($new[$key], $value) ? $new[$key] : fancy_slider_default_opts()[$key];
    // }
    return $input;
}