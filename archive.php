<?php get_header(); ?>
<div class="container mb-40">
	<div class="row">
		<div class="row__column row__column--span-12">
			<header>
				<?php the_archive_title( '<h1>', '</h1>' ); ?>
				<?php the_archive_description( '<p>', '</p>' ); ?>
			</header>
		</div>
		<div class="row__column row__column--span-12 row__column--span-<?php echo is_active_sidebar( 'primary-sidebar' ) ? '8' : '12'; ?>@medium">
			<main>
				<?php get_template_part( 'loop', 'archive' ); ?>
			</main>
		</div>
		<?php if (is_active_sidebar( 'primary-sidebar' )) { ?>
		<div class="row__column row__column--span-12 row__column--span-4@medium">
			<?php get_sidebar(); ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>