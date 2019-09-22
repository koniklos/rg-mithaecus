<?php
// $prep_time: String
$prep_time = get_post_meta($post->ID, '_themename-_pluginname_required_time__themename-preparation-time', true);
// $cook_time: String
$cook_time = get_post_meta($post->ID, '_themename-_pluginname_required_time__themename-cook-time', true);
// $ingredients: Array
$ingredients_list = get_post_meta($post->ID, '_themename_indegient_fields', true);
// $instructions: Array
$instructions_list = get_post_meta($post->ID, '_themename_instructions_fields', true);
// $additional_info: String
$additional_info = get_post_meta($post->ID, '_themename-_pluginname_additional-info', true);
// $serves: String
$serves = get_post_meta($post->ID, '_themename-_pluginname_serves', true);
?>
<article <?php post_class('post post__single'); ?>>
		<svg width="2000" height="2000" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" class="blob">
		<g transform="translate(300,300)">
		<path d="M67.5,-106.7C77.5,-57.5,68.8,-28.8,79.8,11.1C90.9,50.9,121.8,101.8,111.8,133C101.8,164.2,50.9,175.6,-4,179.6C-58.9,183.6,-117.9,180.2,-163,149C-208.2,117.9,-239.6,58.9,-242.4,-2.8C-245.2,-64.6,-219.5,-129.2,-174.3,-178.3C-129.2,-227.5,-64.6,-261.2,-17.9,-243.3C28.8,-225.4,57.5,-155.8,67.5,-106.7Z" fill="#f0dd3e" style="
				fill: #f6f1eb;
		"></path>
		</g>
		</svg>
	
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post__img-hero">
		<?php	the_post_thumbnail( '_themename-img-md-crop' ); ?>
	</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/recipe/header' ); ?>

	<div class="recipe-info">
		<div class="container">
			<div class="row">
				<div class="recipe-info__box row__column row__column--span-6 row__column--span-3@medium">
					<svg class="icon icon--small recipe-info__icon"><use xlink:href="#icon-hourglass-start" /></svg>
					<div class="recipe-info__text"><?php echo $prep_time; ?></div>
					<div class="recipe-info__desc"><?php _e( 'Prep. Time', '_themename' ); ?></div>
				</div>
				<div class="recipe-info__box row__column row__column--span-6 row__column--span-3@medium">
					<svg class="icon icon--small recipe-info__icon"><use xlink:href="#icon-fire" /></svg>
					<div class="recipe-info__text"><?php echo $cook_time; ?></div>
					<div class="recipe-info__desc"><?php _e( 'Cook Time', '_themename' ); ?></div>
				</div>
				<div class="recipe-info__box row__column row__column--span-6 row__column--span-3@medium">
					<svg class="icon icon--small recipe-info__icon"><use xlink:href="#icon-chef" /></svg>
					<div class="recipe-info__text"><?php echo get_the_term_list( $post->ID, '_themename_difficulty' ); ?></div>
					<div class="recipe-info__desc"><?php _e( 'Difficulty', '_themename' ); ?></div>
				</div>
				<div class="recipe-info__box row__column row__column--span-6 row__column--span-3@medium">
					<svg class="icon icon--small recipe-info__icon"><use xlink:href="#icon-utensils" /></svg>
					<div class="recipe-info__text"><?php echo $serves; ?></div>
					<div class="recipe-info__desc"><?php _e( 'Serves', '_themename' ); ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="row__column row__column--span-4@medium row__column--span-3@large">
				<h3 class="recipe__section-title"><?php _e( 'Ingredients', '_themename' ); ?></h3>
			<?php
				$output = '';
				$output .= '<ul class="recipe__list recipe__list__ingredients">';
				foreach ($ingredients_list as $ingredients) {
					$output .= '<li class="recipe__ingredient">' . $ingredients['ingredient'] . '</li>';
				}
				$output .= '</ul>';
				echo $output;
			?>
			</div>
			<div class="row__column row__column--span-8@medium row__column--span-9@large">
			<h3 class="recipe__section-title"><?php _e( 'Instructions', '_themename' ); ?></h3>
			<?php
				$output = '';
				$output .= '<ol class="recipe__list recipe__list__instructions">';
				foreach ($instructions_list as $instructions) {
					$output .= '<li class="recipe__instruction">' . $instructions['instruction'] . '</li>';
				}
				$output .= '</ol>';
				echo $output;
			?>
			</div>
		</div>
	</div>

	<footer class="post__footer">
	<div class="container">
		<p>
			Meal: <?php echo get_the_term_list( $post->ID, '_themename_meal_type', '<span class="recipe__taxonomy__list">', ', ', '</span>' ); ?>
			| Course: <?php echo get_the_term_list( $post->ID, '_themename_course_type', '<span class="recipe__taxonomy__list">', ', ', '</span>' ); ?>
		</p>
	<?php 
	if ( has_category() ) {
		echo '<div class="recipe__cats">';
		$categories = get_the_category_list( ', ' );
		/* translators: %s is the categories */
		printf( esc_html__( 'Posted in %s', '_themename' ), $categories );
		echo '</div>';
	}

	if ( has_tag() ) {
		echo '<div class="recipe__tags">';
		echo '<svg class="icon icon--small icon__tags icon--green"><use xlink:href="#icon-tags" /></svg>';
		$tags = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
		echo $tags;
		echo '</div>';
	}
	?>
	</div>
	</footer>
</article>