<?php

function _themename_theme_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support('html5', array(
		'search-form',
		'comment-list',
		'comment-form',
		'gallery',
		'caption'
	));

	add_theme_support('custom-logo', array(
		'height' 			=> 60,
		'width' 			=> 200,
		'flex-height' => false,
		'flex-width' 	=> false
	));

	add_image_size( '_themename-img-lg' , 1200, 0);
	add_image_size( '_themename-img-md' , 960, 0);
	add_image_size( '_themename-img-md-crop' , 808, 405, array( 'center', 'center' ));
	add_image_size( '_themename-thumb-sm', 244, 200, true );
}

add_action( 'after_setup_theme', '_themename_theme_support' );