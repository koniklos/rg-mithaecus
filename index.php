<?php get_header(); ?>

<div class="container mb-2">
	<div class="row">
		<div class="row__column row__column--span-12 row__column--span-<?php echo is_active_sidebar( 'primary-sidebar' ) ? '8' : '12'; ?>@large">
			<main>
				<?php get_template_part( 'loop', 'index' ); ?>
			</main>
		</div>
		
		<?php if (is_active_sidebar( 'primary-sidebar' )) : ?>

		<div class="row__column row__column--span-12 row__column--span-4@large column-4">
			<?php get_sidebar(); ?>
		</div>

		<?php endif; ?>
	</div>

</div>

<?php get_footer(); ?>