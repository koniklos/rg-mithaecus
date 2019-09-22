<?php
/*
Plugin Name:  _themename _pluginname
Plugin URI:   
Description:  Adds "Recipe" post type and related taxonomies for _themename
Version:      0.0.1
Author:       Yiannis K.
Author URI:   http://github.com/koniklos
License: 			GNU General Public License v2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  _themename-_pluginname
Domain Path:  /languages
*/

// Prevent direct access - If this file is called directly, abort.
// Taken from: https://tommcfarlin.com/prevent-direct-access-to-your-plugin/
if( !defined('WPINC')) {
	die;
}

include_once( 'includes/post-type/recipe-post-type.php' );
include_once( 'includes/taxonomies/meal-type-tax.php' );
include_once( 'includes/taxonomies/course-type-tax.php' );
include_once( 'includes/taxonomies/ingredients-tax.php' );
include_once( 'includes/taxonomies/difficulty-levels-tax.php' );
include_once( 'includes/taxonomies/seasonal-tax.php' );
include_once( 'includes/metaboxes/preparation-time-metabox.php' );
include_once( 'includes/metaboxes/additional-info-metabox.php' );
include_once( 'includes/metaboxes/instructions-metabox.php' );
include_once( 'includes/metaboxes/serves-metabox.php' );
include_once( 'includes/enqueue-assets.php' );

function _themename__pluginname_activate() {
	_themename__pluginname_setup_post_type();
	_themename__pluginname_register_meal_type_tax();
	_themename__pluginname_register_course_type_tax();
	_themename__pluginname_register_difficulty_levels_tax();
	_themename__pluginname_register_seasonals_tax();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, '_themename__pluginname_activate' );

function _themename__pluginname_deactivate() {
	unregister_post_type( '_themename_recipe' );
	unregister_taxonomy( '_themename_meal_type' );
	unregister_taxonomy( '_themename_course_type' );
	unregister_taxonomy( '_themename_difficulty' );
	unregister_taxonomy( '_themename_seasonal' );
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, '_themename__pluginname_deactivate' );