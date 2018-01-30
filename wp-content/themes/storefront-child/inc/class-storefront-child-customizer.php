<?php 
/* description:set up wp customizer API for child theme image upload
   Author:Hai
   Date  :25-09-17
  */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!class_exists('storefront_child_customizer')){
	class storefront_child_customizer{
		public function __construct(){
			add_action('customize_register',array($this,'customize_register'),10);
		}
		
		public static function customize_register($wp_customize){
			$wp_customize->add_section('storefront_child_setting',
					 array(
			                 'title'=>__('Child Settings','Storefront-Child'), 
				             'priority'=>30,
				             'description'=>__('child theme background image')
				             
			));
			$wp_customize->add_setting('brief_info_background_image',
					array(
			              'default'=>'',
			              'type'=>'theme_mod',
				          'transport'=>'postMessage',
			        )			  
			);
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'bg_img',
					 array(
			               'label'=>__('upload image for brief info section','Storefront-Child'),
				           'section'=>'storefront_child_setting',
						   'settings'=>'brief_info_background_image'
			          )
           ));
		   $wp_customize->add_setting('social_media_title',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		   ));
		  $wp_customize->add_control('social_media_title',
		           array(
			               'label'   => 'Title For Social Media',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_title'
		  )
		 );
		$wp_customize->add_setting('social_media_bg',
					array(
		                   'default'  =>  '',
			               'transport'=> 'postMessage'
		));
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'social_media_bg',
					array(
			              'label'  =>  'Background Image For Social Media Section',
			              'section'=>  'storefront_child_setting',
			              'settings'=> 'social_media_bg'
		)));
		$wp_customize->add_setting('social_media_twitter',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		   ));
		  $wp_customize->add_control('social_media_twitter',
		           array(
			               'label'   => 'Twitter Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_twitter'
		  )
		 );
			
		$wp_customize->add_setting('social_media_facebook',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		   ));
		  $wp_customize->add_control('social_media_facebook',
		           array(
			               'label'   => 'Facebook Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_facebook'
		  )
		 );
		$wp_customize->add_setting('social_media_youtube',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		));
		$wp_customize->add_control('social_media_youtube',
		           array(
			               'label'   => 'Youtube Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_youtube'
		  )
		);	
			
		$wp_customize->add_setting('social_media_instagram',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		));
		$wp_customize->add_control('social_media_instagram',
		           array(
			               'label'   => 'Instagram Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_instagram'
		  )
		 );
		
		$wp_customize->add_setting('social_media_google',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		));
		$wp_customize->add_control('social_media_google',
		           array(
			               'label'   => 'Goole Plus Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_google'
		  )
		 );
		
		$wp_customize->add_setting('social_media_pinterest',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		));
		$wp_customize->add_control('social_media_pinterest',
		           array(
			               'label'   => 'Pinterest Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_pinterest'
		  )
		 );
		
		$wp_customize->add_setting('social_media_linkedin',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		));
		$wp_customize->add_control('social_media_linkedin',
		           array(
			               'label'   => 'Linkedin Link',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_linkedin'
		  )
		 );
		$wp_customize->add_setting('social_media_email',
					array(
			               'default' =>  '',
			               'type'=>'theme_mod',
				           'transport'=>'postMessage',        
		));
		$wp_customize->add_control('social_media_email',
		           array(
			               'label'   => 'Email Adress',
			               'type'    => 'text',
			               'section' => 'storefront_child_setting',
			               'settings'=> 'social_media_email'
		  )
		 );
		}
	}
}
return new storefront_child_customizer();

