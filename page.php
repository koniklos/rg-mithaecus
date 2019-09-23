<?php get_header(); ?>
<div class="container mb-2">
	<div class="row">
		<div class="row__column row__column--span-12 row__column--span-12@medium">
			<main>
				<?php get_template_part( 'loop', 'page' ); ?>
			</main>
		</div>
	</div>
</div>
<?php get_footer(); ?>