<?php
	if ( have_posts() ) :
		
		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/post/content', get_post_format() );
			
			if ( get_theme_mod( '_themename_display_author_info', true ) ) {
				get_template_part( 'template-parts/single/author' );
			}
			
			get_template_part( 'template-parts/single/navigation' );
			
				// if ( comments_open() || get_comments_number() ) {
				// 	comments_template();
				// }
		
		endwhile;

	else :
		
		get_template_part( 'template-parts/post/content-none' );
	
	endif;