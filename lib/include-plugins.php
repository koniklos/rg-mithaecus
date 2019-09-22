<?php

require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

function _themename_register_plugins() {
	$plugins = array(
		array(
			'name' 							 => '_themename post layout metabox',
			'slug' 							 => '_themename-post-layout-metabox',
			'source' 						 => get_template_directory_uri() . '/lib/plugins/_themename-post-layout-metabox.zip',
			'required' 					 => true,
			'version' 					 => '0.0.1',
			'force_activation' 	 => false,
			'force_deactivation' => false,
		),
		array(
			'name' 							 => '_themename recipes',
			'slug' 							 => '_themename-recipes',
			'source' 						 => get_template_directory_uri() . '/lib/plugins/_themename-recipes.zip',
			'required' 					 => true,
			'version' 					 => '0.0.1',
			'force_activation' 	 => false,
			'force_deactivation' => false,
		)
	);

	$config = array();

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', '_themename_register_plugins' );