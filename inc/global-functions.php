<?php

function ytc_count() {
	global $ytc;
	if (is_admin())
		echo count($ytc->player->load_videos);
	else
		echo count($ytc->player->load_videos) - 1;
}

function ytc_load_videos() {
	global $ytc;
	$ytc->player->load_videos[] = get_the_ID();
	$ytc->player->options = $ytc->player->get_options();
	if ($ytc->player->options['lightbox'])
		$template = ( file_exists( YTC_TEMPLATE . 'lightbox-video.php') ? YTC_TEMPLATE . 'lightbox-video.php' : YTC_PATH . 'templates/lightbox-video.php' );
	else
		$template = ( file_exists( YTC_TEMPLATE . 'content-video.php') ? YTC_TEMPLATE . 'content-video.php' : YTC_PATH . 'templates/content-video.php' );
	require $template;
}

function ytc_render_video() {

	global $ytc;
	$ytc->player->render_video($ytc->player->load_videos);
}

function ytc_pop_up() { ?>
	<script>
		jQuery(window).load(function() {
			if (typeof(YT) != 'undefined' || typeof(YT.Player) != 'undefined') {
				jQuery('.open-popup-<?php ytc_count(); ?>').magnificPopup({
					type: 'inline',
					midClick: true,
					callbacks: {
						beforeOpen: function () {
							//window.player[<?php ytc_count(); ?>].lightbox = 1;
						},
						open: function () {
							resizeYtPlayer(videos);
						}
					}
				});
			}
		});
	</script>
<? }