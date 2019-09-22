<footer class="post__footer">
	<?php 
	if ( has_category() ) {
		echo '<div class="post__cats">';
		$categories = get_the_category_list( ', ' );
		/* translators: %s is the categories */
		printf( esc_html__( 'Posted in %s', '_themename' ), $categories );
		echo '</div>';
	}

	if ( has_tag() ) {
		echo '<div class="post__tags">';
		$tags = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
		echo $tags;
		echo '</div>';
	}
	?>
</footer>