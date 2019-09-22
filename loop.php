<?php

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();; 
		// Display post content
		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile; 
	_themename_pagination();
else: 
	get_template_part( 'template-parts/post/content-none' );
endif;