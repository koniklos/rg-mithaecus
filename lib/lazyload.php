<?php

function action_lazyload_images() {

	if ( is_admin() ) {
		return;
	}

	if ( is_customize_preview() ) {
		return;
	}

	if ( ! apply_filters( 'lazyload_is_enabled', true ) ) {
		return;
	}

	add_action( 'wp_head', 'action_add_lazyload_filters', PHP_INT_MAX );
	add_action( 'wp_enqueue_scripts', 'action_enqueue_lazyload_assets' );

	// Do not lazy load avatar in admin bar.
	add_action( 'admin_bar_menu', 'action_remove_lazyload_filters', 0 );
	add_filter( 'wp_kses_allowed_html', 'filter_allow_lazyload_attributes' );
}

add_action( 'wp', 'action_lazyload_images' );

function action_add_lazyload_filters() {
	add_filter( 'the_content', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	add_filter( 'post_thumbnail_html', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	add_filter( 'get_avatar', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	add_filter( 'widget_text', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	add_filter( 'get_image_tag', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	add_filter( 'wp_get_attachment_image_attributes', 'filter_lazyload_attributes', PHP_INT_MAX );
}


 // Enqueues and defer lazy-loading JavaScript.
function action_enqueue_lazyload_assets() {
	wp_enqueue_script(	'wp-rig-lazy-load-images', get_theme_file_uri( '/dist/assets/js/lazyload.js' ), array(),	date('ydmGis'),	false	);
	wp_script_add_data( 'wp-rig-lazy-load-images', 'defer', true );
	wp_script_add_data( 'wp-rig-lazy-load-images', 'precache', true );
}

// Removes filters for images that should not be lazy-loaded.
function action_remove_lazyload_filters() {
	remove_filter( 'the_content', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	remove_filter( 'post_thumbnail_html', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	remove_filter( 'get_avatar', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	remove_filter( 'widget_text', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	remove_filter( 'get_image_tag', 'filter_add_lazyload_placeholders', PHP_INT_MAX );
	remove_filter( 'wp_get_attachment_image_attributes', 'filter_lazyload_attributes', PHP_INT_MAX );
}

// Ensures that lazy-loading image attributes are not filtered out of image tags.
function filter_allow_lazyload_attributes( array $allowed_tags ) : array {

	// But, if images are allowed, ensure that our attributes are allowed!
	$allowed_tags['img'] = array_merge(
		$allowed_tags['img'],
		[
			'data-src'    => 1,
			'data-srcset' => 1,
			'data-sizes'  => 1,
			'class'       => 1,
		]
	);

	return $allowed_tags;
}

function filter_add_lazyload_placeholders( string $content ) : string {
	if ( is_feed() || is_preview() ) {
		return $content;
	}

	// Don't lazy-load if the content has already been run through previously.
	if ( false !== strpos( $content, 'data-src' ) ) {
		return $content;
	}

	// Find all <img> elements via regex, add lazy-load attributes.
	$content = preg_replace_callback(
		'#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si',
		function( array $matches ) : string {
			$old_attributes_str       = $matches[2];
			$old_attributes_kses_hair = wp_kses_hair( $old_attributes_str, wp_allowed_protocols() );

			if ( empty( $old_attributes_kses_hair['src'] ) ) {
				return $matches[0];
			}

			$old_attributes = flatten_kses_hair_data( $old_attributes_kses_hair );
			$new_attributes = filter_lazyload_attributes( $old_attributes );

			// If we didn't add lazy attributes, just return the original image source.
			if ( empty( $new_attributes['data-src'] ) ) {
				return $matches[0];
			}

			$new_attributes_str = build_attributes_string( $new_attributes );

			return sprintf( '<img %1$s><noscript>%2$s</noscript>', $new_attributes_str, $matches[0] );
		},
		$content
	);

	return $content;
}


function filter_lazyload_attributes( array $attributes ) : array {
	if ( empty( $attributes['src'] ) ) {
		return $attributes;
	}

	if ( ! empty( $attributes['class'] ) && should_skip_image_with_blacklisted_class( $attributes['class'] ) ) {
		return $attributes;
	}

	$old_attributes = $attributes;

	// Add the lazy class to the img element.
	$attributes['class'] = lazyload_class( $attributes );

	// Set placeholder and lazy-src.
	$attributes['src'] = lazyload_get_placeholder_image();

	// Set data-src to the original source uri.
	$attributes['data-src'] = $old_attributes['src'];

	// Process `srcset` attribute.
	if ( ! empty( $attributes['srcset'] ) ) {
		$attributes['data-srcset'] = $old_attributes['srcset'];
		unset( $attributes['srcset'] );
	}

	// Process `sizes` attribute.
	if ( ! empty( $attributes['sizes'] ) ) {
		$attributes['data-sizes'] = $old_attributes['sizes'];
		unset( $attributes['sizes'] );
	}

	return $attributes;
}


function should_skip_image_with_blacklisted_class( string $classes ) : bool {
	$blacklisted_classes = [
		'skip-lazy',
		'custom-logo',
	];

	foreach ( $blacklisted_classes as $class ) {
		if ( false !== strpos( $classes, $class ) ) {
			return true;
		}
	}
	return false;
}

function lazyload_class( array $attributes ) {
	if ( array_key_exists( 'class', $attributes ) ) {
		$classes  = $attributes['class'];
		$classes .= ' lazy';
	} else {
		$classes = 'lazy';
	}

	return $classes;
}

function lazyload_get_placeholder_image() : string {
	return get_theme_file_uri( '/dist/assets/images/placeholder.svg' );
}

function flatten_kses_hair_data( array $attributes ) : array {
	$flattened_attributes = [];
	foreach ( $attributes as $name => $attribute ) {
		$flattened_attributes[ $name ] = $attribute['value'];
	}
	return $flattened_attributes;
}

function build_attributes_string( array $attributes ) : string {
	$string = [];
	foreach ( $attributes as $name => $value ) {
		if ( '' === $value ) {
			$string[] = sprintf( '%s', $name );
		} else {
			$string[] = sprintf( '%s="%s"', $name, esc_attr( $value ) );
		}
	}

	return implode( ' ', $string );
}

/* OLD VERSION
*****************
function _themename_lazyload_post_thumbnails( $html, $post_id, $post_thumbnail_id ) {

	$dom = new DOMDocument();
	$dom->loadHTML($html);

	$imgEl = new stdClass();

	foreach ($dom->getElementsByTagName('img') as $img) {
		$imgEl->src = $img->getAttribute( 'src' );
		$imgEl->srcset = $img->getAttribute( 'srcset' );
		$imgEl->sizes = $img->getAttribute( 'sizes' );
		$imgEl->alt = $img->getAttribute( 'alt' );
		$imgEl->class = $img->getAttribute( 'class' );
	}

	$html = '<img src="" data-src="' . $imgEl->src . '" alt="' . $imgEl->alt . '" class="' . $imgEl->class . '"  data-srcset="' . $imgEl->srcset . '" data-sizes="' . $imgEl->sizes . '" />';

  return $html;
}
add_filter( 'post_thumbnail_html', '_themename_lazyload_post_thumbnails', 10, 3 );
 */

