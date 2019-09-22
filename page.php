<?php get_header(); ?>

<div class="container mb-2">
	<div class="row">
		<div class="row__column row__column--span-12 row__column--span-8@medium">
			<main>
				<?php get_template_part( 'loop', 'page' ); ?>
			</main>
		</div>
		<div class="row__column row__column--span-12 row__column--span-4@medium">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>