<?php
// Replacing old version of jQuery with latest release
// only in front-end and not in WP administration and Customizer
// to avoid compatibility issues
function wp_jquery_manager_plugin_front_end_scripts() {
	$wp_admin = is_admin();
	$wp_customizer = is_customize_preview();

	if ( $wp_admin || $wp_customizer ) {
		return;
	}

	
	// Deregister WP core jQuery, WP jQuery, WP jQuery Migrate
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'jquery-core' );
	wp_deregister_script( 'jquery-migrate' );

	// Register jQuery in the head
	wp_register_script( 'jquery-core', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), null, false );
	wp_register_script( 'jquery', false, array( 'jquery-core' ), null, false );
	wp_enqueue_script( 'jquery' );
	
	add_filter( 'script_loader_tag', 'add_jquery_attributes', 10, 2 );
}

add_action( 'wp_enqueue_scripts', 'wp_jquery_manager_plugin_front_end_scripts' );


function add_jquery_attributes( $tag, $handle ) {
	if ( 'jquery-core' === $handle ) {
			return str_replace( "type='text/javascript'", "type='text/javascript' integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'", $tag );
	}
	
	return $tag;
}

