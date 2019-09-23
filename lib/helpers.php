<?php

// Convert a multi-dimensional array into a single-dimensional array
function _themename_array_flatten($array) { 
	
	if ( !is_array( $array ) ) { 
		
		return false; 

	}
	
  $result = array(); 
	
	foreach ( $array as $key => $value ) { 
		
		if ( is_array( $value ) ) { 
      $result = array_merge( $result, _themename_array_flatten( $value ) ); 
    } else { 
      $result = array_merge($result, array($key => $value));
		}
		
	}

  return $result; 
}

function _themename_post_meta() {
	/* translators: %s: Post Date */
	printf(
		esc_html__('Posted on %s', '_themename'),
		'<a href="' . esc_url(get_permalink()) . '"><time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_attr(get_the_date()) . '</time></a>'
	);

	/* translators: %s: Post Author */
	printf(
		esc_html__( ' By %s', '_themename' ),
		'<a href="' . esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) . '">' . esc_html(get_the_author())	. '</a>'
	);
}

function _themename_readmore_link() {
	echo '<a href="' . esc_url(get_permalink()) . '" title=" ' . the_title_attribute(['echo' => false]) . '">';

	/* translators: %s: Post Title */
	printf(
		wp_kses(
			__( 'Read More <span class="screen-reader-text">About %s</span>', '_themename' ),
			array (
				'span' => array(
					'class' => array()
				)
			)
		),
		get_the_title()
	);

	echo '</a>';
}

function _themename_meta( $id, $key, $default ) {
	$meta_value = get_post_meta( $id, $key, true );

	if ( !$meta_value && $default ) {
		return $default;
	}

	return $meta_value;
}

function _themename_delete_post() {
	$url = add_query_arg([
		'action' => '_themename_delete_post',
		'post' => get_the_ID(),
		'nonce' => wp_create_nonce( '_themename_delete_post_' . get_the_ID() )
	], home_url());

	if ( current_user_can( 'delete_posts', get_the_ID() ) ) {
		return '<a href="' . esc_url($url) . '">' . esc_html__('Delete Post', '_themename') . '</a>';
	}
}

function _themename_post_thumbnail( $size = null ) {

	if ( has_post_thumbnail() ) {
		$size ? the_post_thumbnail( $size ) : the_post_thumbnail();
	} else {
		$source = get_template_directory_uri() . '/dist/assets/images/screenshot.png';
		$alt = get_the_title();
		?>
		<img class="no-lazy" src="<?php echo $source ?>" alt="<?php echo $alt ?>" />
		<?php
	}

}

function _themename_get_layout() {
	$layout = _themename_meta( get_the_ID(), '__themename_post_layout', 'full' );
	$sidebar = is_active_sidebar( 'primary-sidebar' );

	if ( $layout === 'sidebar' && !$sidebar ) {
		$layout = 'full';
	}

	return $layout;
}

function _themename_layout() {
	echo _themename_get_layout();
}