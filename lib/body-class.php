<?php

function _themename_include_category_in_single( $classes ) {

	if ( is_single() ) {

		global $post;

		foreach( ( get_the_category( $post->ID ) ) as $category ) {

			$classes[] = $category->slug;

		}

	}

	return $classes;

}

add_filter( 'body_class', '_themename_include_category_in_single' );