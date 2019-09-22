<?php

function _themename_add_meta_tags() {
	global $post;

	$description = is_single() ? get_the_excerpt( $post->ID ) : get_bloginfo( 'description' );
	
	echo '<meta name="Description" content="' . $description . '">';
	
}

add_action( 'wp_head', '_themename_add_meta_tags' );