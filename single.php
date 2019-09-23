<?php get_header(); ?>
<div class="container mb-2 single-post-<?php _themename_layout() ?>">
	<div class="row">
		<div class="row__column row__column--span-12 row__column--span-<?php echo _themename_get_layout() === 'sidebar' ? '8' : '12'; ?>@medium">
			<main>
				<?php get_template_part( 'loop', 'single' ); ?>
			</main>
		</div>
		<?php if ( _themename_get_layout() === 'sidebar' ) : ?>
		<div class="row__column row__column--span-12 row__column--span-4@medium">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>