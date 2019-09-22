<?php
$previous_post = get_previous_post();
$next_post = get_next_post();
?>

<?php if ( $previous_post || $next_post ) : ?>
<nav class="post-navigation">
	<h2 class="screen-reader-text"><?php esc_attr_e( 'Post Navigation', '_themename' ); ?></h2>
	<div class="post-navigation__links">
		<?php if ( $previous_post ) : ?>
			<div class="<?php if ( $next_post ) : ?>post-navigation__post post-navigation__post--prev<?php else : ?>post-navigation--full<?php endif; ?>">
				<a href="<?php the_permalink( $previous_post->ID ) ?>" class="post-navigation__link">
					<?php if ( has_post_thumbnail( $previous_post->ID ) ) : ?>
						<div class="post-navigation__thumbnail">
							<?php echo get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ) ?>
						</div>
					<?php endif; ?>
					<div class="post-navigation__content">
						<span class="post-navigation__title">
							<?php echo esc_html( get_the_title( $previous_post->ID ) ); ?>
						</span>
					</div>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( $next_post ) : ?>
			<div class="<?php if ( $previous_post ) : ?>post-navigation__post post-navigation__post--next<?php else : ?>post-navigation--full<?php endif; ?>">
				<a href="<?php the_permalink( $next_post->ID ) ?>" class="post-navigation__link">
					<?php if ( has_post_thumbnail( $next_post->ID ) ) : ?>
						<div class="post-navigation__thumbnail">
							<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) ?>
						</div>
					<?php endif; ?>
					<div class="post-navigation__content">
						<span class="post-navigation__title">
							<?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
						</span>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</nav>
<?php endif; ?>