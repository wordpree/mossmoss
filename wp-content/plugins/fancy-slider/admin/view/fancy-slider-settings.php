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
function fs_default_opts(){
    return array(
            'multi_number'=> array(
                'sli_qty' => '1',
                'scr_qty' => '1',
                'ap_spd'  => '3000',
                'trs_spd' => '300',
                'ctr_pad' => '50',
            ),
            'multi_checkbox'=> array('arrow','infinite'),
            'radio' => 'slide'                                       
    );
}
function fs_sanitize_options($input){
    return $input;
}
function fs_fields_callback($args){
    if ( isset($args) && is_array($args) ){
        $field = $args['field'];
    }else{
        return;
    }

    $html = '';
    $option_name = 'fancy_slider_options';
    $options = get_option( $option_name, fs_default_opts() );
    $type = $field['type'];
    $option_args = $field['options'];

    if ( isset( $option_args ) && is_array( $option_args)  ){

        foreach ($option_args as $value => $label) {   //$id $name $in_value $type $label

            $id = esc_attr( $type . '_' . $value );
            $d_value = $options[$type];
            $in_value = esc_attr( $value );
            $label_l = $label_r = $label;
            $checked = '';

            switch ( $type ) {
                case 'multi_checkbox':
                    $name = "$option_name" . "[multi_checkbox][]";
                    $checked = in_array($value, $d_value ) ? 'checked' : '';
                    $label_l = '';
                    break;
                
                case 'radio':
                    $name = "$option_name" . "[radio]";
                    $checked = checked( $value,$d_value , false );
                    $label_l = '';
                    break;

                case 'multi_number':
                    $name = "$option_name" . "[multi_number][$value]";
                    $d_value = $options[$type][$value];
                    $in_value = esc_attr( $d_value );
                    $label_r = '';
                    break;
            }

            $type_temp = explode('_', $type);
            if ( empty($type_temp) ){ //invalid type ,return
                return;
            };
            
            $html .= "<li><label for='$id'>" . $label_l . " <input type=" . end($type_temp) . " name='$name' value='$in_value' id='$id' $checked> " .$label_r . "</label></li> ";
        }
        echo '<ul>' . $html . '</ul>';
    }
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
                'id' => 'multi_checkbox_format',                 //field register $id
                'sub_title' => 'Format Setting',                 //field register $title
                'brief'     =>  'Please tick your slider format',
                'type'      => 'multi_checkbox',
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
                    'fade'   => 'Fade'
                )
            ),
            array(
                'id' => 'number_digital',
                'sub_title' => 'Digital Parameter',
                'brief'     =>  'Please input your parameter here',
                'type'      =>  'multi_number',
                'options'   => array(
                    'sli_qty' => 'Display Quantity',
                    'scr_qty' => 'Scroll Quantity',
                    'ap_spd'  => 'Autoplay Speed',
                    'trs_spd' => 'transition Speed',
                    'ctr_pad' => 'Centre Padding'  
                )
            )                 
        )
    );
    $settings = apply_filters( 'fancy_slider_settings', $settings );
    return $settings;
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