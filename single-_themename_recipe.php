<?php get_header(); ?>
<?php
$layout = _themename_meta( get_the_ID(), '__themename_post_layout', 'full' );
$sidebar = is_active_sidebar( 'primary-sidebar' );

if ( $layout === 'sidebar' && !$sidebar ) {
	$layout = 'full';
}
?>
<div class="container mb-2 single-post-<?php echo $layout ?>">
	<div class="row">
		<div class="row__column row__column--span-12 row__column--span-<?php echo $layout === 'sidebar' ? '8' : '12'; ?>@medium">
			<main>
				<?php get_template_part( 'loop', 'recipe' ); ?>
			</main>
		</div>
		<?php if ( $layout === 'sidebar' ) : ?>
		<div class="row__column row__column--span-12 row__column--span-4@medium">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>