<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class acool_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		//require_once( trailingslashit( get_template_directory() ) . 'share/customizer-pro/section-pro.php' );
		get_template_part('/includes/customizer-pro/section-pro');
		// Register custom section types.
		$manager->register_section_type( 'acool_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new acool_Customize_Section_Pro(
				$manager,
				'acool',
				array(
					'title'    => esc_html__( 'Acool Pro', 'acool' ),
					'priority'	=> 8,	
					'pro_text' => esc_html__( 'Upgrade to Pro',         'acool' ),
					'pro_url'  => 'https://www.coothemes.com/themes/acool.php'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'acool-customize-controls', trailingslashit( get_template_directory_uri() ) . 'includes/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'acool-customize-controls', trailingslashit( get_template_directory_uri() ) . 'includes/customizer-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
acool_Customize::get_instance();
