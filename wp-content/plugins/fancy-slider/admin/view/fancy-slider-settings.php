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
* function to create default fancy_slider_options if achieve failed*
*@since 0.1.0
*@var function
*@return void
**/
function fs_default_opts(){
    return array(
            'wpfs_standard'  => array( 'sli_qty' => '1','scr_qty' => '1'), 
            'wpfs_format'    => array( 'arrow','inf' ),
            'wpfs_animation' => array( 'slide', 'trans_spd'=>'200', 'trans_cur'=>'ease'), 
            'wpfs_centre'    => array( '', 'padding' => '50' ),   
            'wpfs_autoplay'  => array( '', 'speed' => '3000'),
            'wpfs_lazyload'  => array( 'ondemand','img_name'=>'' ),
    );
}

/**
* function to generate field settings *
*@since 0.1.0
*@var function
*@return settings array
**/
function fs_settings_field(){
    $settings['basic'] = array(
        'title'    => 'Slider Basic Settings',                   //section title
        'content'  => 'Slider basic settings are listed below',  //section cb content
        'page'     => 'fancy-slider',  //page
        'scb'      => 'fs_sanitize_options',  //sanitize callback function
        'fcb'      => 'fs_fields_callback',   //field callback function
        'fields'   => array(

            array(
                'id' => 'wpfs_standard',              //field register $id , option name
                'sub_title' => 'Standard Parameter',  //field register $title
                'brief'     => 'Set quantity of sliders to show or to scroll at one time',
                'type'      => array(                 //field input type ,value and its label
                    'number' => array( 'sli_qty' => 'Display Quantity','scr_qty' => 'Scroll Quantity' )
                )
            ),
            array(
                'id' => 'wpfs_lazyload',                 //field register $id , option name
                'sub_title' => 'Lazy Loading',        //field register $title
                'brief'     => 'load the image as soon as you slide it or loads one image after another when the page loads',
                'type'      => array(                  //field input type ,value and its label
                    'radio'    => array('progressive' => 'Progressive','ondemand' => 'Ondemand'),
                    'textarea' => array('img_name'    => 'lazy loading img name,eg: img1.jpg , img2.png' ),
                )
            ),
            array(
                'id' => 'wpfs_centre',                 //field register $id , option name
                'sub_title' => 'Centre Enable',        //field register $title
                'brief'     => 'Enables centered view with partial prev/next slides',
                'type'      => array(                  //field input type ,value and its label
                    'checkbox' => array('centre'  => 'Centred Mode'   ),
                    'number'   => array('padding' => 'Centre Padding'),
                )
            ),
            array(
                'id' => 'wpfs_autoplay',                 //field register $id , option name
                'sub_title' => 'Autoplay Enable',        //field register $title
                'brief'     => 'Enable sliders infinitely play within specific time changing interval',
                'type'      => array(                    //field input type ,value and its label
                    'checkbox' => array('autoplay' => 'Autoplay Mode'   ),
                    'number'   => array('speed'    => 'Auto Play Speed' ),
                )
            ),
            array(
                'id' => 'wpfs_animation',                //field register $id , option name
                'sub_title' => 'Animation Type',         //field register $title
                'brief'     => 'Sliders transition in two ways,sliding or fade-in-out',
                'type'      => array(                    //field input type ,value and its label
                    'radio'  => array('slide'     => 'Slide','fade' => 'Fade' ),
                    'number' => array('trans_spd' => 'Transition Speed' ),
                    'text'   => array('trans_cur' => 'transition Curve' ),
                )
            ),
            array(
                'id' => 'wpfs_format',                 //field register $id , option name
                'sub_title' => 'Format Setting',        //field register $title
                'brief'     => 'You can select whatever your slider formats look like',
                'type'      => array(                   //field input type ,value and its label
                    'checkbox'=> array(
                        'dot'    => 'Dot Indicator',
                        'inf'    => 'Infinite Loop',
                        'arrow'  => 'Next/Prev Arrows',
                        'rtl'    => 'Right to Left',
                        'fonect' => 'Focus On Select'
                    )
                )
            )                 
        )
    );
    $settings = apply_filters( 'fancy_slider_settings', $settings );
    return $settings;
}

/**
* function to creat basic section callback *
*@since 0.1.0
*@var function
*@return void
**/
function fs_section_callback_basic($args){
    $settings = fs_settings_field();
    $html = '<p>' . $settings[ $args['id'] ]['content'] . '</p>';
    _e( $html, 'fancy-slider' ); 
}

/**
* function to sanitize fancy_slider_options before inputing into database *
*@since 0.1.0
*@var function
*@param (array) $input
*@return void
**/
function fs_sanitize_options($input){
    return $input;
}


/**
* function to create all types of display areas *
*@since 0.1.0
*@var function
*@param (array) $args ,pass by add_settings_field
*@return void
**/
function fs_fields_callback($args){
    if ( isset($args) && is_array($args) ){
        $field = $args['field'];
    }else{
        return;
    }
  
    $html     = '';
    $_name    = '';
    $_checked = '';
    $_type    = '';
    $_id      = '';
    $_value   = '';
    $_label   = '';
    $_placehoder = '';
    $option_name = $field['id'];
    $types = $field['type'];
    $db_option = get_option( $option_name, fs_default_opts()[$option_name]);
    
    
    foreach ($types as $type => $option) {

        $_type = esc_attr( $type );
        foreach ($option as $value => $label) {

            $_label   = $label ;
            $_label_l = '';
            $_id = esc_attr( $option_name . '_' . $value );
            switch ( $_type ) {
                case 'checkbox':
                case 'radio':

                    $_name    = esc_attr( $option_name . '[]' );
                    $_value   = esc_attr( $value );
                    $_checked = checked( in_array($value, $db_option ), true, false );
                    break;
                
                case 'number':
                case 'text':

                    $_name    = esc_attr( $option_name . "[$value]" );
                    $_value   = esc_attr( $db_option[$value] );
                    $_checked = '';
                    $_label_l = $_label;
                    $_label   = '';
                    break;

                case 'textarea':
                    $_placehoder = $label;
                    $_name    = esc_attr( $option_name . "[$value]" );
                    $_value   = esc_attr( $db_option[$value] );
                    break;

            }
            if ( $type === 'textarea' ) {
                $html .= "<li><textarea rows=4 cols=24 placeholder='$label' name='$_name'  id='$_id'>" .$_value. "</textarea></li>";              
            }else{
                $html .= "<li><label for='$_id'>" .$_label_l. "<input type='$_type'  name='$_name'  id='$_id' $_checked value='$_value'>" .$_label."</label></li>";
            }
            
        }
        $class = str_replace('wpfs_', '', $option_name);
        if ( end( $types ) === $option ){ //apend brief description after field completion
            $html  = "<ul class=$class>" . $html . "</ul>";
            $html .= "<span>" . $field['brief'] . "</span>";
        }
    }
    echo $html;
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