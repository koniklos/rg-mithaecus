<?php

function _themename_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_template_directory_uri() . '/dist/assets/favicon.ico" />';
 }

add_action('wp_head', '_themename_favicon');