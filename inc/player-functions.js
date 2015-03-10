// // RESPONSIVE SIZE
// if (ytcustomizr_width_value == '%') {
	// var ytcustomizr_width_pure = jQuery('#player').parent().width() * (ytcustomizr_width / 100);
	// var ytcustomizr_width_value_original = '%';
// } else if (ytcustomizr_width > jQuery('#player').parent().width()) {
	// var ytcustomizr_width_original = ytcustomizr_width;
	// var ytcustomizr_width_value_original = 'px';
	// ytcustomizr_width = 100
	// ytcustomizr_width_value = '%';
// } else {
	// var ytcustomizr_width_pure = ytcustomizr_width
	// var ytcustomizr_width_original = ytcustomizr_width;
	// var ytcustomizr_width_value_original = 'px';
// }
//
// jQuery(document).on('ready', function() {
	// jQuery(window).on('resize', function() {
		// if (ytcustomizr_width_original < jQuery('#player').parent().width() && ytcustomizr_width_value_original == 'px') {
			// jQuery('#player').width(ytcustomizr_width_original);
		// }
		// if (ytcustomizr_width_original > jQuery('#player').parent().width() && ytcustomizr_width_value_original == 'px') {
			// jQuery('#player').width(jQuery('#player').parent().width());
		// }
		// jQuery('#player').attr('height', (jQuery('#player').width() / ytcustomizr_ratio_width) * ytcustomizr_ratio_height);
	// }).trigger('resize')
// }).trigger('ready')

// LOAD THE PLAYER
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function loadYtCustomizr(videoId, startSeconds, endSeconds, volume, suggestedQuality, width, widthValue, ratioWidth, ratioHeight, controls, showInfo, autoHide, theme, color, modestBranding, autoPlay, loop, rel, playbackRate) {

	var player;
	var videoId = videoId;
	var startSeconds = startSeconds;
	var endSeconds = endSeconds;
	var volume = volume;
	var suggestedQuality = suggestedQuality;
	var width = width;
	var widthValue = widthValue;
	var ratioWidth = ratioWidth;
	var ratioHeight = ratioHeight;
	if (controls == 1) {
		var controls = 0;
	} else {
		var controls = 1;
	}
	var showInfo = showInfo;
	var autoHide = autoHide;
	var theme = theme;
	var color = color;
	var modestBranding = modestBranding;
	var ivLoadPolicy = ivLoadPolicy;
	var autoPlay = autoPlay;
	var loop = loop;
	var rel = rel;
	var playbackRate = playbackRate;
	if (widthValue == '%') {
		var widthPure = jQuery('#player').parent().width() * (width / 100);
		var widthValueOriginal = '%';
	} else if (width > jQuery('#player').parent().width()) {
		var widthOriginal = width;
		var widthValueOriginal = 'px';
		width = 100;
		widthValue = '%';
		var widthPure = width;
	} else {
		var widthPure = width;
		var widthOriginal = width;
		var widthValueOriginal = 'px';
	}
	var done = false;

	window.onYouTubeIframeAPIReady = function() {

		player = new YT.Player('player', {
			height : (widthPure / ratioWidth) * ratioHeight,
			width : width + widthValue,
			videoId : videoId,
			playerVars : {
				'controls' : controls,
				'showinfo' : showInfo,
				'autohide' : autoHide,
				'theme' : theme,
				'color' : color,
				'modestbranding' : modestBranding,
				'iv_load_policy' : ivLoadPolicy,
				'start' : startSeconds,
				'end' : endSeconds,
				'autoplay' : autoPlay,
				'rel' : rel
			},
			events : {
				'onReady' : onPlayerReady,
				'onStateChange' : onPlayerStateChange
			}
		});

	}
	
	// SOUNDCHECK
	function ytcustomizr_soundcheck() {
		if (volume == 0) {
			player.mute();
			jQuery('.eq').addClass('mute');
		} else {
			player.unMute();
			player.setVolume(volume);
		}
	}

	//LOOP
	function ytcustomizr_replay() {
		if (loop === 1) {
			player.seekTo(startSeconds, true);
		}
	}

	//PLAYBACK RATE
	function ytcustomizr_setplaybackrate() {
		player.setPlaybackRate(playbackRate);
	}

	//PLAYBACK QUALITY
	function ytcustomizr_setquality() {
		player.setPlaybackQuality(suggestedQuality);
	}

	window.onPlayerReady = function(evt) {
		ytcustomizr_setplaybackrate();
		ytcustomizr_setquality();
		ytcustomizr_soundcheck();
	}

	window.onPlayerStateChange = function(event) {
		var done = false;

		//if (event.data == YT.PlayerState.PLAYING && !done) {
		//	done = true;
		//}

		if (event.data == YT.PlayerState.ENDED && !done) {
			ytcustomizr_replay();
			done = true;
		}
	}
}

