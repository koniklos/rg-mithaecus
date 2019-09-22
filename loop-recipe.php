<?php
	if ( have_posts() ) :
		
		while ( have_posts() ) :
			the_post();

get_template_part( 'template-parts/recipe/content', get_post_format() );

		endwhile;

	else :
		
		get_template_part( 'template-parts/post/content-none' );
	
	endif;