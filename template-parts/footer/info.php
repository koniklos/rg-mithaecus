<?php 
$footer_background = get_theme_mod( '_themename_footer_background', 'dark' );
$site_info = get_theme_mod( '_themename_site_info', '' );
?>
<?php if ( $site_info ) : ?>
<div class="site-info site-info--<?php echo _themename_sanitize_footer_background($footer_background); ?>">
	<div class="container">
		<div class="row">
			<div class="row__column row__column--span-12 site-info__text">
				<?php 
				$allowed = array('a' => array(
					'href' => array(),
					'title' => array()
				));
				echo wp_kses( $site_info, $allowed );
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>