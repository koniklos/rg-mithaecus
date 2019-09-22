<div class="post-author mb-1">
	<h2 class="screen-reader-text"><?php esc_html_e( 'About the author', '_themename' ); ?></h2>
	<?php
		$author_id = get_the_author_meta( 'ID' );
		$author_posts = get_the_author_posts();
		$author_display = get_the_author();
		$author_posts_url = get_author_posts_url( $author_id );
		$author_description = get_the_author_meta( 'user_description' );
		$author_website = get_the_author_meta( 'user_url' );
	?>
	<div class="post-author__avatar">
		<?php echo get_avatar( $author_id, 265 ); ?>
	</div>
	<div class="post-author__content">
		<div class="post-author__title">
			<?php if ( $author_website ) { ?>
			<a target="_blank" href="<?php echo esc_url( $author_website ); ?>">
			<?php } ?>
				<?php echo esc_html( $author_display ); ?>
			<?php if ( $author_website ) { ?>
			</a>
			<?php } ?>
		</div>

		<div class="post-author__info">
			<a href="<?php echo esc_url( $author_posts_url ); ?>">
				<?php
					printf(
						esc_html(
							_n( '%s post', '%s posts', $author_posts, '_themename' )
						),
						number_format_i18n( $author_posts )
					);
				?>
			</a>
		</div>
		
		<?php if ( $author_description ) { ?>
		<div class="post-author__desc">
			<?php echo esc_html( $author_description ); ?>
		</div>
		<?php } ?>
	</div>
</div>