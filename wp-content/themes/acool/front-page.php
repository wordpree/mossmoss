<?php
/**
* The front page template
*
*/


if ( 'posts' == get_option( 'show_on_front' ) )
{
	//echo 'index.php';
	get_template_part('index');
}
else
{	
	get_template_part( 'front-page-content' ); //front-page-content.php

}

