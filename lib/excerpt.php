<?php

function _themename_custom_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', '_themename_custom_excerpt_length', 999 );