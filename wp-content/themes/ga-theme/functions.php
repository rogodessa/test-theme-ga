<?php

define('GA_THEME_DIRECTORY', get_stylesheet_directory() );
define('GA_THEME_URL', get_stylesheet_directory_uri() );

require_once GA_THEME_DIRECTORY . '/includes/class-ga-theme-cpt.php';
require_once GA_THEME_DIRECTORY . '/includes/class-shortcodes.php';

/**
 * Theme support
 */
add_action( 'after_setup_theme', function(){
	add_theme_support( 'title-tag' );
	add_theme_support('post-thumbnails');
}, 99 );

/**
 * Change post_type for home page
 */
add_action( 'pre_get_posts', function($query){
	if (is_admin()) return;

	if(is_front_page()) {
		$query->set('post_type', 'album');
	}
});


add_filter( 'wp_enqueue_scripts', function(){
	$theme = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_script('theme-scripts', GA_THEME_URL . '/assets/js/scripts.js', ['jquery'], $version, true);

});