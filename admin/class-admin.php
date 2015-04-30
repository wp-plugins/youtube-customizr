<?php

class YT_Admin {

	protected $player;
	protected $options;
	protected $error;
	protected $skipped;

	public function __construct() {
		//Create new instance of YT_Player to easily retrieve the players options.
		$this->player  = new YT_Player;
		$this->options = $this->player->get_options();
		$this->error   = '';
		$this->skipped = 0;
	}

	// Register the admin scripts
	public function enqueue_scripts() {
		wp_enqueue_style( 'ytc-admin-css', YTC_URL . 'admin/admin.css' );
		wp_enqueue_script( 'ytc-admin-scripts', YTC_URL . 'admin/admin-functions.js', array(
			'jquery',
			'jquery-ui-slider'
		), '1.0' );
		wp_enqueue_script( 'ytc-player-functions', YTC_URL . 'inc/player-functions.js', array( 'jquery' ), '1.0' );
		wp_enqueue_script( 'ytc-functions', YTC_URL . 'inc/ytc-functions.js', array( 'jquery' ), '1.0', true );
	}

	// Register the custom post type for our YouTube videos
	public function video_post_type() {
		$args = array(
			'labels'        => array(
				'name'           => __( 'Videos', 'youtube-customizr' ),
				'singular_name'  => __( 'Video', 'youtube-customizr' ),
				'menu_name'      => __( 'YouTube', 'youtube-customizr' ),
				'all_items'      => __( 'Videos', 'youtube-customizr' ),
				'name_admin_bar' => __( 'YouTube video', 'youtube-customizr' ),
				'add_new'        => _x( 'Add new', 'video', 'youtube-customizr' ),
				'add_new_item'   => __( 'Add new YouTube video', 'youtube-customizr' )
			),
			'public'        => true,
			'has_archive'   => true,
			'show_ui'       => true,
			'menu_position' => 10,
			'description'   => 'Give your YouTube Videos a custom look and feel with YouTube Customizr',
			'rewrite'       => array( 'slug' => 'youtube-videos' ),
			'supports'      => array( 'title', 'thumbnail' ),
			'menu_icon'     => YTC_URL . 'admin/admin-icon.png'
		);

		register_post_type( 'youtube-videos', $args );
		add_image_size( 'youtube-video', 360, 203, true );
	}

	public function video_archive( $template ) {
		if ( is_post_type_archive('youtube-videos') ) {
			$theme_files = array('archive-youtube-videos.php', 'youtube-customizr/archive-videos.php');
			$exists_in_theme = locate_template($theme_files, false);
			if ( $exists_in_theme != '' ) {
				return $exists_in_theme;
			} else {
				$template = YTC_PATH . 'templates/archive-videos.php';
			}
		}
		return $template;
	}

	// Adds the settings page to the wordpress menu
	public function settings() {

		add_submenu_page(
			'edit.php?post_type=youtube-videos',
			__( 'Youtube Customizr Settings', 'youtube-customizr' ),
			_x( 'Settings', 'video', 'youtube-customizr' ),
			'publish_posts',
			'yt-video-settings',
			array( $this, 'render_settings' )
		);

		add_submenu_page(
			'edit.php?post_type=youtube-videos',
			__( 'Import Channels to Youtube Customizr', 'youtube-customizr' ),
			_x( 'Import', 'video', 'youtube-customizr' ),
			'publish_posts',
			'yt-video-import',
			array( $this, 'import' )
		);

	}

	// Import by channel
	public function import() {
		require_once YTC_PATH . 'admin/import.php';
	}

	// Render the settings page
	public function render_settings() {
		$this->options = $this->player->get_options();
		require_once YTC_PATH . 'admin/general-settings.php';
	}

	// Adds the meta boxes to our YouTube video post type
	public function video_meta_boxes() {
		$this->options = $this->player->get_options();

		if ( $this->options['video'] ) {
			add_meta_box(
				'ytc-render-video',
				__( 'Video Preview', 'youtube-customizr' ),
				array( $this, 'admin_video' ),
				'youtube-videos',
				'normal'
			);
		}

		add_meta_box(
			'ytc-video-url',
			__( 'The Video', 'youtube-customizr' ),
			array( $this, 'url_settings' ),
			'youtube-videos',
			'normal'
		);

		//if ($this->options['video']) {
		add_meta_box(
			'ytc-video-settings',
			__( 'Video Settings', 'youtube-customizr' ),
			array( $this, 'video_settings' ),
			'youtube-videos',
			'normal'
		);

		add_meta_box(
			'ytc-playback-settings',
			__( 'Playback Settings', 'youtube-customizr' ),
			array( $this, 'playback_settings' ),
			'youtube-videos',
			'advanced'
		);

		add_meta_box(
			'ytc-control-settings',
			__( 'Player controls', 'youtube-customizr' ),
			array( $this, 'control_settings' ),
			'youtube-videos',
			'advanced'
		);

		add_meta_box(
			'ytc-shortcode',
			__( 'Video shortcode', 'youtube-customizr' ),
			array( $this, 'video_shortcode' ),
			'youtube-videos',
			'side'
		);

		add_meta_box(
			'ytc-video_info',
			__( 'Video Information', 'youtube-customizr' ),
			array( $this, 'video_info' ),
			'youtube-videos',
			'side',
			'low'
		);
		//}
	}

	// Render the video
	public function admin_video() {
		$this->options = $this->player->get_options();
		$this->player->load_video();
		$this->player->render_video();
	}

	// Render the video meta box
	public function url_settings() {
		$this->options = $this->player->get_options();
		require_once YTC_PATH . 'admin/url-settings.php';
	}

	// Render the video meta box
	public function video_settings() {
		$this->options = $this->player->get_options();
		require_once YTC_PATH . 'admin/video-settings.php';
	}

	// Render the playback meta box
	public function playback_settings() {
		$this->options = $this->player->get_options();
		require_once YTC_PATH . 'admin/playback-settings.php';
	}

	// Render the controls meta box
	public function control_settings() {
		$this->options = $this->player->get_options();
		require_once YTC_PATH . 'admin/control-settings.php';
	}

	// Render the shortcode meta box
	public function video_shortcode() {
		$this->options = $this->player->get_options();
		echo '<p class="howto">';
		_e( 'Put this shortcode into your post to show your customized YouTube video.', 'youtube-customizr' );
		echo '</p>';
		echo '<input type="text" value="[youtube id=&quot;' . $this->options['post_id'] . '&quot;]" readonly="readonly" class="wp-ui-text-highlight code">';
	}

	// Render the shortcode meta box
	public function video_info() {
		echo '<p><strong>' . $this->options['title'] . '</strong></p>';
		echo '<p>' . substr( $this->options['description'], 0, 160 ) . '<span class="more-description">' . substr( $this->options['description'], 160 ) . ' </span> <a class="read-more"><span>' . __( 'More', 'youtube-customizr' ) . '</span><span class="hide">' . __( 'Less', 'youtube-customizr' ) . '</span></a></p>';
		echo '<table class="video-details"><tbody><tr>';
		echo '<td><i>' . __( 'Channel', 'youtube-customizr' ) . ': </i></td><td>' . $this->options['channel'] . '</td>';
		echo '</tr><tr>';
		echo '<td><i>' . __( 'Published on', 'youtube-customizr' ) . ': </i></td><td>' . $this->options['publish_date'] . '</td>';
		echo '</tr><tr>';
		echo '<td><i>' . __( 'Duration', 'youtube-customizr' ) . ': </i></td><td>' . $this->options['time'] . '</td>';
		echo '</tr><tr>';
		echo '<td><i>' . __( 'Quality', 'youtube-customizr' ) . ': </i></td><td>' . $this->options['definition'] . '</td>';
		echo '</tr></tbody></table>';
	}

	public function video_thumbnail( $image_url, $image_id, $post_id = null ) {
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents( $image_url );
		$filename   = $image_id . '-' . basename( $image_url );
		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents( $file, $image_data );

		$wp_filetype = wp_check_filetype( $filename, null );
		$attachment  = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);
		$attach_id   = wp_insert_attachment( $attachment, $file, $post_id );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		set_post_thumbnail( $post_id, $attach_id );
	}

	// Updates all settings / post meta after saving our settings.
	public function update_settings() {
		$this->options = $this->player->get_options();
		foreach ( $_POST as $option => $value ) {
			// Some values needs a somewhat different approach.
			if ( $option == 'width' ) {
				$value = ( intval( $value ) == 0 ) ? $value = 100 : intval( $value );
			}
			if ( $option == 'video' && $_POST['url'] != NULL ) {
				preg_match( '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x', $_POST['url'], $matches );
				$value = $matches[1];

				//Save the info from the API
				$this->video_info = json_decode( file_get_contents( 'https://www.googleapis.com/youtube/v3/videos?id=' . $value . '&part=snippet,contentDetails&key=' . YTC_KEY ), true );

				update_post_meta( $this->options['post_id'], 'ytc_title', $this->video_info['items'][0]['snippet']['title'] );
				update_post_meta( $this->options['post_id'], 'ytc_description', $this->video_info['items'][0]['snippet']['description'], 0, 160 );
				update_post_meta( $this->options['post_id'], 'ytc_channel', $this->video_info['items'][0]['snippet']['channelTitle'] );
				update_post_meta( $this->options['post_id'], 'ytc_definition', $this->video_info['items'][0]['contentDetails']['definition'] );

				$video_publish_date = date( 'd F Y', strtotime( $this->video_info['items'][0]['snippet']['publishedAt'] ) );
				update_post_meta( $this->options['post_id'], 'ytc_publish_date', $video_publish_date );

				$video_date = new DateTime( '1970-01-01' );
				$video_date->add( new DateInterval( $this->video_info['items'][0]['contentDetails']['duration'] ) );
				update_post_meta( $this->options['post_id'], 'ytc_time', $video_date->format( 'i:s' ) );
				update_post_meta( $this->options['post_id'], 'ytc_seconds', $video_date->format( 'i' ) * 60 + $video_date->format( 's' ) );

				$thumbnail = array_pop( $this->video_info['items'][0]['snippet']['thumbnails'] )['url'];
				$this->video_thumbnail( $thumbnail, $value );
			}
			//Check if we are editting the general settings or a certain video
			if ( ! isset( $_POST['general'] ) ) {
				if ( $value == get_option( 'ytc_' . $option ) ) {
					delete_post_meta( $this->options['post_id'], 'ytc_' . $option );
				} else {
					update_post_meta( $this->options['post_id'], 'ytc_' . $option, $value );
				}
			} else {
				update_option( 'ytc_' . $option, $value );
			}
		}

		$this->options = $this->player->get_options();
	}

	public function add_schedules( $schedules ) {
		// Adds once weekly to the existing schedules.
		$schedules['weekly']  = array(
			'interval' => 604800,
			'display'  => __( 'Once Weekly', 'youtube-customizr' )
		);
		$schedules['monthly'] = array(
			'interval' => 18144000,
			'display'  => __( 'Once Monthly', 'youtube-customizr' )
		);

		return $schedules;
	}

	public function import_videos( $import = null, $import_value = null, $break = false ) {

		var_dump($import, $import_value, $break);

		$import       = ( $import ? $import : $_POST['import'] );
		$import_value = ( $import_value ? $import_value : $_POST['import_value'] );
		$this->failed = __( 'Import Failed', 'youtube-customizr' );

		if ( $import == 'user' ) {

			$this->video_info = json_decode( file_get_contents( 'https://www.googleapis.com/youtube/v3/channels?forUsername=' . $import_value . '&part=contentDetails&maxResults=50&key=' . YTC_KEY ), true );

			if ( $this->video_info['pageInfo']['totalResults'] == 0 ) {
				echo '<div class="error"><p>' . $this->failed . '. ' . __( 'This Channel doesn\'t exist', 'youtube-customizr' ) . '.</p></div>';

				return;
			}

			if ( ! $this->video_info['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ) {
				echo '<div class="error"><p>' . $this->failed . '. ' . __( 'This user dit not upload any videos', 'youtube-customizr' ) . '.</p></div>';

				return;
			}

			$this->playlist = $this->video_info['items'][0]['contentDetails']['relatedPlaylists']['uploads'];


		} else if ( $import == 'playlist' ) {
			$this->playlist = $import_value;
		}

		$content = @file_get_contents( 'https://www.googleapis.com/youtube/v3/playlistItems?playlistId=' . $this->playlist . '&part=snippet,contentDetails&maxResults=50&key=' . YTC_KEY );
		if ( $content ) {
			$this->video_info = json_decode( $content, true );
		}

		if ( ! $content || $this->video_info['pageInfo']['totalResults'] == 0 ) {
			echo '<div class="error"><p>' . $this->failed . '. ' . __( 'This playlist doesn\'t exist', 'youtube-customizr' ) . '.</p></div>';

			return;
		}

		$args        = array( 'post_type' => 'youtube-videos', 'posts_per_page' => - 1 );
		$match_query = new WP_Query( $args );

		if ( $match_query->have_posts() ) {
			while ( $match_query->have_posts() ) : $match_query->the_post();
				$this->match_videos[] = get_post_meta( get_the_ID(), 'ytc_video', true );
			endwhile;
		}

		for ( $page = 0; $page < $this->video_info['pageInfo']['totalResults']; $page = $page + 50 ) {

			for ( $row = 0; $row < count( $this->video_info['items'] ); $row ++ ) {

				if ( ! isset( $this->match_videos ) || ! in_array( $this->video_info['items'][ $row ]['contentDetails']['videoId'], $this->match_videos ) ) {
					$args = array(
						'post_status' => 'publish',
						'post_type'   => 'youtube-videos',
						'post_title'  => $this->video_info['items'][ $row ]['snippet']['title'],
					);
					//var_dump($args);
					$this->post_id = wp_insert_post( $args );
					update_post_meta( $this->post_id, 'ytc_url', 'https://www.youtube.com/watch?v=' . $this->video_info['items'][ $row ]['contentDetails']['videoId'] );
					update_post_meta( $this->post_id, 'ytc_video', $this->video_info['items'][ $row ]['contentDetails']['videoId'] );
					update_post_meta( $this->post_id, 'ytc_description', $this->video_info['items'][ $row ]['snippet']['description'] );
					update_post_meta( $this->post_id, 'ytc_channel', $this->video_info['items'][ $row ]['snippet']['channelTitle'] );
					$video_publish_date = date( 'd F Y', strtotime( $this->video_info['items'][ $row ]['snippet']['publishedAt'] ) );
					update_post_meta( $this->post_id, 'ytc_publish_date', $video_publish_date );

					$this->video_detail = json_decode( file_get_contents( 'https://www.googleapis.com/youtube/v3/videos?id=' . $this->video_info['items'][ $row ]['contentDetails']['videoId'] . '&part=snippet,contentDetails&key=' . YTC_KEY ), true );
					update_post_meta( $this->post_id, 'ytc_definition', $this->video_detail['items'][0]['contentDetails']['definition'] );
					$video_date = new DateTime( '1970-01-01' );
					$video_date->add( new DateInterval( $this->video_detail['items'][0]['contentDetails']['duration'] ) );
					update_post_meta( $this->post_id, 'ytc_time', $video_date->format( 'i:s' ) );
					update_post_meta( $this->post_id, 'ytc_seconds', $video_date->format( 'i' ) * 60 + $video_date->format( 's' ) );

					$thumbnail = array_pop( $this->video_detail['items'][0]['snippet']['thumbnails'] )['url'];
					$this->video_thumbnail( $thumbnail, $this->video_info['items'][ $row ]['contentDetails']['videoId'], $this->post_id );
				} else {
					if ( $break ) {
						return;
					}
					$this->skipped ++;
				}

			}

			if ( $page + 50 < $this->video_info['pageInfo']['totalResults'] ) {
				$this->video_info = json_decode( file_get_contents( 'https://www.googleapis.com/youtube/v3/playlistItems?playlistId=' . $this->playlist . '&part=snippet,contentDetails&maxResults=50&pageToken=' . $this->video_info['nextPageToken'] . '&key=' . YTC_KEY ), true );
			}
		}

		if ( $_POST['recurring'] != 'none' ) {
			wp_schedule_event( time(), $_POST['recurring'], 'import_videos_recurring', array(
				'user' => $import,
				'import' => $import_value,
				'break' => true
			) );
		}

		echo '<div class="updated"><p>' . __( 'Import succeeded', 'youtube-customizr' ) . '. ' . ( $this->video_info['pageInfo']['totalResults'] - $this->skipped ) . ' ' . __( 'Videos were succesfully imported', 'youtube-customizr' ) . ( $this->skipped ? ' &amp; ' . $this->skipped . ' ' . __( 'videos were skipped because they already existed', 'youtube-customizr' ) : '' ) . '.</p></div>';

	}

}
