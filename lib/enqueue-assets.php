<?php

function _themename_assets() {
	wp_enqueue_style( '_themename-stylesheet', get_template_directory_uri() . 
	'/dist/assets/css/bundle.css', array(), date('ydmGis'), 'all' );

	// wp_enqueue_script( '_themename-lazyload', get_template_directory_uri() . 
	// '/dist/assets/js/lazyload.js', array(), date('ydmGis'), true );

	wp_enqueue_script( '_themename-scripts', get_template_directory_uri() . 
	'/dist/assets/js/bundle.js', array('jquery'), '20190922', true );

	wp_enqueue_script( '_themename-modernizr', get_template_directory_uri() . 
	'/dist/assets/js/modernizr-build.js', array(), '20190922', false );



	// Comment Reply for singular post/pages where comments are open
	// and the thread comments option in admin is enabled
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_enqueue_scripts', '_themename_assets');

function _themename_customize_preview_script() {
	wp_enqueue_script('_themename-customize_preview', get_template_directory_uri() . 
	'/dist/assets/js/customize-preview.js', 
	array('customize-preview', 'jquery'), '20190922', true);
}

add_action('customize_preview_init', '_themename_customize_preview_script');