window.player = [];

(function( $ ) {

	// LOAD THE PLAYER
	var tag = document.createElement('script');
	tag.src = "//www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


	window.loadYtCustomizr = function(video_array) {

		var video_array = video_array;

		for (row = 0; row < video_array.length ; row++) {

			// Invert control value
			if (video_array[row]['controls'] == 0) {
				video_array[row]['showinfo'] = 0;
			}

			// Width Ratio
			if (video_array[row]['width_ratio'] == 1) {
				video_array[row]['ratio_width'] = 4;
				video_array[row]['ratio_height'] = 3;
			} else {
				video_array[row]['ratio_width'] = 16;
				video_array[row]['ratio_height'] = 9;
			}

			// Responsive width & height
            if (video_array[row]['width_value'] == '%') {
                video_array[row]['width_pure'] = $('#player-'+row).parent().width() * (video_array[row]['width'] / 100);
                video_array[row]['width_value_original'] = '%';
            } else if (video_array[row]['width'] > $('#player-'+row).parent().width()) {
                video_array[row]['width_original'] = video_array[row]['width'];
                video_array[row]['width_value_original'] = 'px';
                video_array[row]['width'] = 100;
                video_array[row]['width_value'] = '%';
                video_array[row]['width_pure'] = video_array[row]['width'];
            } else {
                video_array[row]['width_pure'] = video_array[row]['width'];
                video_array[row]['width_original'] = video_array[row]['width'];
                video_array[row]['width_value_original'] = 'px';
            }
			var done = false;

		}

		window.onYouTubeIframeAPIReady = function() {


			for (row = 0; row < video_array.length ; row++) {

                window.player.push(new YT.Player('player-'+row, {
                    height: (video_array[row]['width_pure'] / video_array[row]['ratio_width']) * video_array[row]['ratio_height'],
                    width: video_array[row]['width'] + video_array[row]['width_value'],
                    videoId: video_array[row]['video'],
                    playerVars: {
                        'controls': video_array[row]['controls'],
                        'showinfo': video_array[row]['showinfo'],
                        'autohide': video_array[row]['autohide'],
                        'theme': video_array[row]['theme'],
                        'color': video_array[row]['color'],
                        'modestbranding': video_array[row]['modestbranding'],
                        'iv_load_policy': video_array[row]['iv_load_policy'],
                        'start': video_array[row]['start'],
                        'end': video_array[row]['end'],
                        'autoplay': video_array[row]['autoplay'],
                        'rel': video_array[row]['rel'],
                        'wmode': 'opaque',
                        'enablejsapi': 1
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                }));
			}

		}

		// SOUNDCHECK
		//function ytcustomizr_soundcheck() {
		//	if (volume == 0) {
		//		player.mute();
		//		$('.eq').addClass('mute');
		//	} else {
		//		player.unMute();
		//		player.setVolume(volume);
		//	}
		//}

		//LOOP
		function ytcustomizr_replay() {
			if (loop === 1) {
				player.seekTo(startSeconds, true);
			}
		}

        ytcustomizr_play = function(evt) {
               evt.target.playVideo();
        }

		//PLAYBACK RATE
		//function ytcustomizr_setplaybackrate() {
		//	player.setPlaybackRate(playbackRate);
		//}

		//PLAYBACK QUALITY
		//function ytcustomizr_setquality() {
		//	player.setPlaybackQuality(suggestedQuality);
		//}

		window.onPlayerReady = function(evt) {
			//ytcustomizr_setplaybackrate();
			//ytcustomizr_setquality();
			//ytcustomizr_soundcheck();
            if (evt.target.lightbox) {
                ytcustomizr_play(evt);
                evt.target.lightbox = 0;
            }
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

    window.resizeYtPlayer = function(video_array) {

        var video_array = video_array;

        for (row = 0; row < video_array.length; row++) {

            // Responsive width & height
            if (video_array[row]['width'] > $('#player-'+row).parent().width()) {
                video_array[row]['width_original'] = video_array[row]['width'];
                video_array[row]['width_value_original'] = 'px';
            } else {8
                video_array[row]['width_original'] = video_array[row]['width'];
                video_array[row]['width_value_original'] = 'px';
            }

            if (video_array[row]['width_original'] < $('#player-' + row).parent().width() && video_array[row]['width_value_original'] == 'px') {
                $('#player-' + row).width(video_array[row]['width_original']);
            }
            if (video_array[row]['width_original'] > $('#player').parent().width() && video_array[row]['width_value_original'] == 'px') {
                $('#player-' + row).width($('#player-' + row).parent().width());
            }
            $('#player-' + row).attr('height', ($('#player-' + row).width() / video_array[row]['ratio_width']) * video_array[row]['ratio_height']);
       }

    }

})(jQuery);
