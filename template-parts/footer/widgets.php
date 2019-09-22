<?php
	$footer_layout = sanitize_text_field(get_theme_mod('_themename_footer_layout', '3,3,3,3'));
	$footer_layout = preg_replace('/\s+/', '', $footer_layout);
	$columns = explode(',', $footer_layout);
	$footer_background = get_theme_mod('_themename_footer_background', 'dark');
	$widgets_active = false;
	foreach ($columns as $i => $column) {
		if (is_active_sidebar( 'footer-sidebar-' . ($i + 1) )) {
			$widgets_active = true;
		}
	}
?>

<?php if ($widgets_active) { ?>
<div class="footer footer--<?php echo $footer_background; ?>">
	<div class="container">
		<div class="row">
			<?php foreach ($columns as $i => $column) { ?>
				<div class="row__column row__column--span-12 row__column--span-<?php echo $column; ?>@medium">
					<?php if (is_active_sidebar( 'footer-sidebar-' . ($i + 1) )) {
						dynamic_sidebar( 'footer-sidebar-' . ($i + 1) );
					} ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>