<?php 

/**
 * Move jQuery to the footer. 
 */
function wpse_173601_enqueue_scripts() {
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}
add_action( 'wp_enqueue_scripts', 'wpse_173601_enqueue_scripts' );

add_action('wp_enqueue_scripts', 'assets_inc_method');

function assets_inc_method() {
/**
* Styles
*/
	wp_enqueue_style( 'theme-style-main', get_template_directory_uri() . '/style.css' );
	// wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/js/fancy/jquery.fancybox.min.css' );
	wp_enqueue_style( 'uikit', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/dev.css' );

/**
* scripts
*/

	// wp_enqueue_script('jquery','' ,'',1);

	// wp_deregister_script( 'jquery' );
	// wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min-1.9.1.js');
	// // wp_enqueue_script( 'jquery' ,'' ,'',1);
	// wp_enqueue_script( 'jquery', '', '',1 );

	// wp_deregister_script( 'jquery' );
	// wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	// wp_enqueue_script( 'jquery' );

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),'', 1);
	// wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/fancy/jquery.fancybox.min.js', array('jquery'),'',1);
	// wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'),'',1);
	// wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.js', array('jquery'),'',1);
	// wp_enqueue_script('uikit', get_template_directory_uri() . '/js/uikit.min.js', array('jquery'), '',1);
	// wp_enqueue_script('formstyler', get_template_directory_uri() . '/js/jquery.formstyler.min.js', array('jquery'),'',1);

	wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.js', array('jquery'),'',1);

}


