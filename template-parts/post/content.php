<?php
$is_single = is_single();
$has_post_thumbnail = has_post_thumbnail();
?>
<?php if ( $is_single ) : ?>
<article <?php post_class('post post__single'); ?>>
		<svg width="2000" height="2000" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" class="blob">
		<g transform="translate(300,300)">
		<path d="M67.5,-106.7C77.5,-57.5,68.8,-28.8,79.8,11.1C90.9,50.9,121.8,101.8,111.8,133C101.8,164.2,50.9,175.6,-4,179.6C-58.9,183.6,-117.9,180.2,-163,149C-208.2,117.9,-239.6,58.9,-242.4,-2.8C-245.2,-64.6,-219.5,-129.2,-174.3,-178.3C-129.2,-227.5,-64.6,-261.2,-17.9,-243.3C28.8,-225.4,57.5,-155.8,67.5,-106.7Z" fill="#f0dd3e" style="
				fill: #f6f1eb;
		"></path>
		</g>
		</svg>
	
	<?php if ( $has_post_thumbnail ) : ?>
	<div class="post__img-hero">
		<?php	the_post_thumbnail( '_themename-img-md-crop' ); ?>
	</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/post/header' ); ?>

	<div class="post__content">
		<?php the_content(); ?>
	</div>

	<?php get_template_part( 'template-parts/post/footer' ); ?>
</article>

<?php	else:	?>

<article <?php post_class('post post--list mb-2'); ?>>
	<?php if ( $has_post_thumbnail ) : ?>
	<div class="post__thumbnail">
		<?php	the_post_thumbnail( '_themename-thumb-sm' ); ?>
		<div class="post__thumbnail--fade" style="background-image: url(<?php the_post_thumbnail_url('_themename-thumb-sm'); ?>)"></div>
	</div>	
	<?php endif; // thumbnail found... ?>

	<div class="post__inner">		
		<?php get_template_part( 'template-parts/post/header' ); ?>
		<div class="post__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<p class="post__read-more"><?php _themename_readmore_link(); ?></p>
	</div>

</article>
<?php endif; ?>
