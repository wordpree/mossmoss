<?php 

/**
* Class designed here to fulfill functionality of fancy slider widget
* @package fancy-slider
* @subpackage fancy-slider/includes/widgets
* @var class
* @since  0.1.0
* @author Hai 
**/

class Fancy_Slider_Widget extends WP_Widget {

	public function __construct(){
		parent::__construct('fancy-slider','Fancy Slider',array('description' => 'Slide Your Images'));
		add_action( 'widgets_init', function(){
			register_widget('Fancy_Slider_Widget');
		} );
	}

	public function widget($args, $instance){
	    require_once plugin_dir_path( __FILE__ ) . '../../admin/class-fancy-slider-admin.php';
		Fancy_Slider_Admin::admin_cpt_featured_img_interface();
	}

	public function form($instance){
    	$title = ! empty ($instance['title']) ? $instance['title'] : esc_html__( 'New Title','fancy-slider' ); ?>
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) );?>"><?php echo esc_attr_e('Title','fancy-slider')?></label>
		  <input class='widefat' id="<?php echo esc_attr( $this->get_field_id( 'title' ) );?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type='text' value="<?php echo esc_attr( $title );?>" >
		</p>
	<?php }

	public function update($new_instance, $old_instance){
	    $instance = $old_instance;
	    $instance['title'] = ( !empty( $new_instance ) ) ? strip_tags( $new_instance['title'] ): '';
	    return $instance;
	}


}
return new Fancy_Slider_Widget();
?>