<?php
if (isset($_POST['action'])) {
	$this->update_settings();
}
?>

<div class="wrap">
	<h2><?php _e('Youtube Customizr General Settings', 'youtube-customizr'); ?></h2>
	<form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="action" value="update">
		<?php
			require_once YTC_PATH . 'admin/video-settings.php';
			require_once YTC_PATH . 'admin/playback-settings.php';
			require_once YTC_PATH . 'admin/control-settings.php';
			submit_button();
		?>
	</form>
</div>