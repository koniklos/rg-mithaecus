<?php

function _themename_include_svg_icon_sprite() {

	$svg_sprite = get_stylesheet_directory() . '/dist/assets/images/svg-sprite/svg-icon-sprite.svg';
	if ( file_exists( $svg_sprite ) ) {
		
		// echo $svg_sprite;
		require_once( $svg_sprite );

	}

}

add_action( 'wp_footer', '_themename_include_svg_icon_sprite', 9999 );
