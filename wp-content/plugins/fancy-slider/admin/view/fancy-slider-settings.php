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
            'wpfs_centre'    => array( 'disable', 'padding' => '50' ),   
            'wpfs_autoplay'  => array( 'disable', 'speed' => '3000'),
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
        'fcb'      => 'fs_fields_callback',   //field callback function
        'fields'   => array(

            array(
                'id' => 'wpfs_standard',              //field register $id , option name
                'cb' => 'fs_standard_sanitize',     // register setting callback
                'sub_title' => 'Standard Parameter',  //field register $title
                'brief'     => 'Set quantity of sliders to show or to scroll at one time',
                'type'      => array(                 //field input type ,value and its label
                    'number' => array( 'sli_qty' => 'Slider Quantity','scr_qty' => 'Scroll Quantity' )
                )
            ),
            array(
                'id' => 'wpfs_lazyload',                 //field register $id , option name
                'cb' => 'fs_lazyload_sanitize',        // register setting callback
                'sub_title' => 'Lazy Loading',           //field register $title
                'brief'     => 'load the image as soon as you slide it or loads one image after another when the page loads',
                'type'      => array(                    //field input type ,value and its label
                    'radio'    => array('ondemand' => 'Ondemand','progressive' => 'Progressive' ),
                    'textarea' => array('img_name' => 'lazy loading img name,eg: img1.jpg , img2.png' ),
                )
            ),
            array(
                'id' => 'wpfs_centre',                 //field register $id , option name
                'cb' => 'fs_centre_sanitize',        // register setting callback
                'sub_title' => 'Centre View Style',        //field register $title
                'brief'     => 'Enables centered view with partial prev/next slides',
                'type'      => array(                  //field input type ,value and its label
                    'radio'    => array('enable'  => 'Enable Centre View' , 'disable'  => 'Disable Centre View' ),
                    'number'   => array('padding' => 'Centre Padding'),
                )
            ),
            array(
                'id' => 'wpfs_autoplay',                 //field register $id , option name
                'cb' => 'fs_autoplay_sanitize',        // register setting callback
                'sub_title' => 'Autoplay Style',        //field register $title
                'brief'     => 'Enable sliders infinitely play within specific time changing interval',
                'type'      => array(                    //field input type ,value and its label
                    'radio'    => array('enable' => 'Enable Autoplay','disable' => 'Disable Autoplay' ),
                    'number'   => array('speed'  => 'Autoplay Speed' ),
                )
            ),
            array(
                'id' => 'wpfs_animation',                //field register $id , option name
                'cb' => 'fs_animation_sanitize',       // register setting callback
                'sub_title' => 'Animation Type',         //field register $title
                'brief'     => 'Sliders transition in two ways,sliding or fade-in-out',
                'type'      => array(                    //field input type ,value and its label
                    'radio'  => array('fade' => 'Fade','slide'     => 'Slide'),
                    'number' => array('trans_spd' => 'Transition Speed' ),
                    'text'   => array('trans_cur' => 'Transition Curve' ),
                )
            ),
            array(
                'id' => 'wpfs_format',                  //field register $id , option name
                'cb' => 'fs_format_sanitize',         // register setting callback
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
* function to sanitize options before inserting into database *
*@since 0.1.0
*@var function
*@param (array) $input
*@return void
**/

function fs_standard_sanitize($input){
    $temp = $input;
    foreach ( $input as $key=>$value ){
        if( ! isset($value)){
            $temp[$key] = null;
        }else{
            $temp[$key] = fs_sanitize_digital( $value) ? $value : null;            
        }
    }
    return $temp;
}

function fs_lazyload_sanitize($input){
    $temp = $input;
    if ( isset($input[0]) ){
        $temp[0] = in_array( $input[0], array('ondemand','progressive') ) ? $input[0] : null;
    }else{
        $temp[0] = null;
    }
    if ( isset($input['img_name']) ){
        $temp['img_name'] = sanitize_textarea_field( $input['img_name'] ) ;
    }else{
        $temp['img_name'] = null;
    }
    return $temp;
}

function fs_centre_sanitize($input){
    $temp = $input;

    foreach ( $input as $key=>$value ){
        if ( isset($value)  ){
            if ( is_int($key) ){
                $temp[$key] = in_array( $value, array('enable','disable') ) ? $value : null;
            }else{
                $temp[$key] = fs_sanitize_digital( $value ) ? $value : null;
            }
        }else{
            $temp[$key] = null;
        }
    }
    return $temp;
}

function fs_animation_sanitize($input){
    $temp = $input;
    if ( isset($input[0]) ){
        $temp[0] = in_array( $input[0], array('slide','fade') ) ? $input[0] : null;
    }else{
        $temp[0] = null;
    }
    if ( isset($input['trans_spd']) ){
        $temp['trans_spd'] = fs_sanitize_digital( $input['trans_spd'] ) ? $input['trans_spd'] : null;
    }else{
        $temp['trans_spd'] = null;
    }
    if ( isset($input['trans_cur']) ){
        $temp['trans_cur'] = sanitize_text_field( $input['trans_cur'] ) ;
    }else{
        $temp['trans_cur'] = null;
    }
    return $temp;
}

function fs_format_sanitize($input){
    $temp = $input;
    foreach ( $input as $key=>$value ){
        if ( isset($input[$key]) ){
            $temp[$key] = in_array($value, array('dot','inf','arrow','rtl','fonect') ) ? $value : null;
        }else{
            $temp[$key] = null;
        }
    }
    return $temp;
}
function fs_autoplay_sanitize($input){
    $temp = $input;
    if ( isset($input[0]) ){
        $temp[0] = in_array( $input[0], array('disable','enable') ) ? $input[0] : null;
    }else{
        $temp[0] = null;
    }
    if ( isset($input['speed']) ){
        $temp['speed'] = fs_sanitize_digital( $input['speed'] ) ? $input['speed'] : null;
    }else{
        $temp['img_name'] = null;
    }
    return $temp;
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
    $db_option = empty( $db_option ) ? fs_default_opts()[$option_name] : $db_option;
 
    foreach ($types as $type => $option) {

        $_type = esc_attr( $type );
        foreach ($option as $value => $label) {

            $_label   = '<span>' . $label .'</span>';
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
                $html .= "<li><textarea rows=4 cols=24 placeholder='$label' name='$_name'  id='$_id'> " .$_value. "</textarea></li> ";              
            }else{
                $html .= "<li><label for='$_id'>" .$_label_l. " <input type='$_type'  name='$_name'  id='$_id' $_checked value='$_value'> " .$_label. "</label></li> ";
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
