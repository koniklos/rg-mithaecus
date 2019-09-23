<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a href="#content" class="skip-link"><?php esc_attr_e( 'Skip to content', '_themename' ); ?></a>
	<header class="main-header mb-2">
		<div class="main-header__wrapper">
			<div class="main-header__container container clearfix">
				<div class="main-header__logo">
					<?php if (has_custom_logo()) {
						the_custom_logo();
					} else { ?>
						<a href="<?php echo esc_url(home_url( '/' )); ?>" class="main-header__blogname text--undecorated text--serif"
						 ><?php esc_html(bloginfo( 'name' )); ?></a>
				<?php } ?>
				</div>
				<button class="btn searchbar__toggle" aria-label="<?php esc_attr_e( 'Toggle the Search bar', '_themename' ); ?>" aria-expanded="false" aria-controls="main-searchbar">
					<span class="btn__content" tabindex="-1">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon--small searchbar__toggle__icon icon--dark" viewBox="0 0 512 512" height="512" width="512"><g class="nc-icon-wrapper js-transition-icon" data-effect="rotate" data-event="click"><g class="js-transition-icon__state"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></g><g class="js-transition-icon__state" aria-hidden="true" style="display: none;">
							<path d="M427.7,16.2L15.1,428.9c-10.9,10.9-10.9,28.7,0,39.6L37,490.4c10.9,10.9,28.7,10.9,39.6,0L489.3,77.8 c10.9-10.9,10.9-28.7,0-39.6l-21.9-21.9C456.4,5.3,438.7,5.3,427.7,16.2z"></path><path d="M489.3,428.9L76.6,16.2C65.6,5.3,47.9,5.3,37,16.2L15.1,38.2c-10.9,10.9-10.9,28.7,0,39.6l412.7,412.7	c10.9,10.9,28.7,10.9,39.6,0l21.9-21.9C500.2,457.6,500.2,439.9,489.3,428.9z"></path></g></g>
						</svg>
					</span>
				</button>
				<button class="btn navbar__toggle" aria-label="<?php esc_attr_e( 'Toggle the Menu', '_themename' ); ?>" aria-expanded="false" aria-controls="menu-main-memu">
					<span class="btn__content" tabindex="-1">
						<span class="navbar__toggle-box" aria-hidden="true">
							<span class="navbar__toggle-box__inner" aria-hidden="true"></span>
						</span>
					</span>
				</button>
				<div class="navbar clearfix">
					<nav class="navbar__main navbar__main--not-active navbar__main--small" aria-label="<?php esc_html_e( 'Main Navigation', '_themename' ); ?>">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								// 'container_class' => 'main-nav main-nav--not-active main-nav--large clearfix',
								'container' => false,
								'menu_class' => 'menu',
								'walker' => new _themename_primary_navigation()
								)
							);
						?>
					</nav>
				</div>
			</div>
		</div>
			<div id="main-searchbar" class="main-header__searchbar">
				<div class="searchbar__container container">
					<?php get_search_form( true ); ?>
				</div>
			</div>
	</header>
	<div id="content">
		