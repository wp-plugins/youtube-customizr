<?php

class YT_Admin {

	protected $player;
	protected $options;
	
	public function __construct() {
		//Create new instance of YT_Player to easily retrieve the players options.
		$this->player = new YT_Player;
		$this->options = $this->player->get_options();
	}

	// Register the admin scripts
	public function enqueue_scripts() {
			wp_enqueue_style( 'ytc-admin-css', YTC_URL . 'admin/admin.css' );
			wp_enqueue_script( 'ytc-admin-scripts', YTC_URL . 'admin/admin-functions.js', array( 'jquery','jquery-ui-slider' ), '1.0');
			wp_enqueue_script( 'player-functions', YTC_URL . 'inc/player-functions.js', array( 'jquery' ), '1.0');
	}
	
	// Register the custom post type for our YouTube videos
	public function video_post_type() {
	    $args = array(
	        'labels'         	=> array(
	        	'name' => __('Videos','youtube-customizr'), 
	        	'singular_name'  	=> __('Video','youtube-customizr'),
	        	'menu_name' 		=> __('YouTube','youtube-customizr'),
	        	'all_items' 		=> __('Videos','youtube-customizr'),
	        	'name_admin_bar' 	=> __('YouTube video','youtube-customizr'),
	        	'add_new' 			=> _x('Add new', 'video','youtube-customizr'),
				'add_new_item'		=> __('Add new YouTube video','youtube-customizr')
			),
	        'public'        	=> false,
	        'has_archive'    	=> true,
	        'show_ui'			=> true,
	        'menu_position' 	=> 10,
	        'description'   	=> 'Give your YouTube Videos a custom look and feel with YouTube Customizr',
	        'rewrite'        	=> array('slug' => 'yt-videos'),
	        'supports'      	=> array( 'title', 'thumbnail'),
	        'menu_icon'			=> YTC_URL . 'admin/admin-icon.png'
	    );
	 
	    register_post_type('yt-videos', $args);
	}

	// Adds the settings page to the wordpress menu
	public function settings() {

		add_submenu_page(
			'edit.php?post_type=yt-videos',
			__('Youtube Customizr Settings','youtube-customizr'), 
			_x('Settings','video','youtube-customizr'),
			'publish_posts',
			'yt-video-settings',
			array( $this, 'render_settings' )
		);

	}

	// Render the settings page
	public function render_settings() {
		$this->options = $this->player->get_options();
		require_once YTC_PATH . 'admin/general-settings.php';
	}

	// Adds the meta boxes to our YouTube video post type
	public function video_meta_boxes() {

		add_meta_box(
			'ytc-render_video',
			__( 'Video Preview', 'youtube-customizr' ),
			array( $this, 'render_video' ),
			'yt-videos',
			'normal'
		);

		add_meta_box(
			'ytc-video-settings',
			__( 'Video Settings', 'youtube-customizr' ),
			array( $this, 'video_settings' ),
			'yt-videos',
			'normal'
		);
		
		add_meta_box(
			'ytc-playback-settings',
			__( 'Playback Settings', 'youtube-customizr' ),
			array( $this, 'playback_settings' ),
			'yt-videos',
			'advanced'
		);
		
		add_meta_box(
			'ytc-control-settings',
			__( 'Player controls', 'youtube-customizr' ),
			array( $this, 'control_settings' ),
			'yt-videos',
			'advanced'
		);
		
		add_meta_box(
			'ytc-shortcode',
			__( 'Video shortcode', 'youtube-customizr' ),
			array( $this, 'video_shortcode' ),
			'yt-videos',
			'side'
		);
		
		add_meta_box(
			'ytc-video_info',
			__( 'Video Information', 'youtube-customizr' ),
			array( $this, 'video_info' ),
			'yt-videos',
			'side',
			'low'
		);
		
	}
	
	// Change the title of the custom post type
	public function change_title( $title ){
     	$screen = get_current_screen();
	     if  ( 'yt-videos' == $screen->post_type )
	          $title = __('Enter your video link here', 'youtube-customizr');
	     return $title;
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
		_e('Put this shortcode into your post to show your customized YouTube video.','youtube-customizr');
		echo '</p>';
		echo '<input type="text" value="[yt_customizr '.$this->options['post_id'].']" readonly="readonly" class="wp-ui-text-highlight code">';
	}

	// Render the shortcode meta box
	public function video_info() {
		echo '<p><strong>'.$this->options['title'].'</strong></p>';
		echo '<p>'.$this->options['description'].'</p>';
		echo '<table class="video-details"><tbody><tr>';
		echo '<td><i>'.__('Channel','youtube-customizr').': </i></td><td>'.$this->options['channel'].'</td>';
		echo '</tr><tr>';
		echo '<td><i>'.__('Published on','youtube-customizr').': </i></td><td>'.$this->options['publish_date'].'</td>';
		echo '</tr><tr>';
		echo '<td><i>'.__('Duration','youtube-customizr').': </i></td><td>'.$this->options['time'].'</td>';
		echo '</tr><tr>';
		echo '<td><i>'.__('Quality','youtube-customizr').': </i></td><td>'.$this->options['definition'].'</td>';
		echo '</tr></tbody></table>';
	}

	// Render the video(s)
	public function render_video() {
		$this->options = $this->player->get_options();
		if ($this->options['video']) {
			echo '	
				<div id="player"></div>	
					
				<script>
					loadYtCustomizr(
						"'.$this->options['video'].'", 
						0, 
						100, 
						'.$this->options['volume'].', 
						"'.$this->options['suggestedquality'].'", 
						'.$this->options['width'].', 
						"'.$this->options['width_value'].'", 
						16, 
						9, 
						'.$this->options['controls'].', 
						'.$this->options['showinfo'].', 
						'.$this->options['autohide'].', 
						"'.$this->options['theme'].'", 
						"'.$this->options['color'].'", 
						'.$this->options['modestbranding'].', 
						'.$this->options['autoplay'].', 
						'.$this->options['loop'].', 
						'.$this->options['rel'].', 
						'.$this->options['playbackrate'].'
					)
				</script>';
		}
	}

	public function video_thumbnail($image_url){
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents($image_url);
		$filename = basename($image_url);
		if(wp_mkdir_p($upload_dir['path']))
			$file = $upload_dir['path'] . '/' . $filename;
		else
			$file = $upload_dir['basedir'] . '/' . $filename;
		file_put_contents($file, $image_data);

		$wp_filetype = wp_check_filetype($filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => sanitize_file_name($filename),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		set_post_thumbnail( $post_id, $attach_id );
	}
	
	// Updates all settings / post meta after saving our settings.
	public function update_settings(){
		$this->options = $this->player->get_options();
		foreach ($_POST as $option => $value) {
			// Some values needs a somewhat different approach.
			if ( $option == 'width' ) $value = (intval($value) == 0) ? $value = 100 : intval($value);
			if ( $option == 'video' ) {
				preg_match('#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x', $_POST['post_title'], $matches);
				$value = $matches[1];

				//Save the info from the API
				$this->video_info = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $value . '&part=snippet,contentDetails&key=AIzaSyDA4IWPgHnV0O7_iTqRifSKUpPnnucI5EY'), true);

				update_post_meta($this->options['post_id'], 'ytc_title', $this->video_info['items'][0]['snippet']['title']);
				update_post_meta($this->options['post_id'], 'ytc_description', substr($this->video_info['items'][0]['snippet']['description'], 0, 160));
				update_post_meta($this->options['post_id'], 'ytc_channel', $this->video_info['items'][0]['snippet']['channelTitle']);
				update_post_meta($this->options['post_id'], 'ytc_definition', $this->video_info['items'][0]['contentDetails']['definition']);

				$video_publish_date = date('d F Y', strtotime($this->video_info['items'][0]['snippet']['publishedAt']));
				update_post_meta($this->options['post_id'], 'ytc_publish_date', $video_publish_date);

				$video_date = new DateTime('1970-01-01');
				$video_date->add(new DateInterval($this->video_info['items'][0]['contentDetails']['duration']));
				update_post_meta($this->options['post_id'], 'ytc_time', $video_date->format('i:s'));
				update_post_meta($this->options['post_id'], 'ytc_seconds', $video_date->format('i') * 60 + $video_date->format('s'));

				$this->video_thumbnail($this->video_info['items'][0]['snippet']['thumbnails']['standard']['url']);
			}
			//Check if we are editting the general settings or a certain video
			if($this->options['post_id']) {
					if ( $value == get_option('ytc_'.$option ) ) {
						delete_post_meta($this->options['post_id'], 'ytc_'.$option);
					} else {
						update_post_meta($this->options['post_id'], 'ytc_'.$option, $value);
					}
			} else {
				update_option('ytc_'.$option, $value);
			}
		}

		$this->options = $this->player->get_options();
	}
}
