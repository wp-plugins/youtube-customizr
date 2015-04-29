<?php

class YT_Customizr {

	protected $loader;
	protected $plugin_slug;
	protected $screen;
	public $player;

	public function __construct() {
		$this->plugin_slug = 'youtube-videos';
			
		$this->load_dependencies();
		$this->define_hooks();
	}

	private function load_dependencies() {
		require_once YTC_PATH . 'admin/class-admin.php';
		require_once YTC_PATH . 'inc/class-loader.php';
		require_once YTC_PATH . 'inc/class-player.php';
		$this->loader = new YT_Loader();
	}
	
	public function language() {
	 	load_plugin_textdomain( 'youtube-customizr', false, YTC_BASE . '/languages/' ); 
	}

	private function define_hooks() {
		$admin = new YT_Admin();
		$player = new YT_Player();
		$this->player = $player;
		$this->loader->add_action( 'wp_enqueue_scripts', $player, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $admin, 'settings' );
		$this->loader->add_action( 'init', $admin, 'video_post_type' );
		$this->loader->add_action( 'init', $this, 'language' );
		$this->loader->add_action( 'add_meta_boxes', $admin, 'video_meta_boxes' );
		$this->loader->add_action( 'save_post', $admin, 'update_settings' );
		$this->loader->add_shortcode( 'youtube', $player, 'load_video' );
		$this->loader->add_shortcode( 'youtube_latest', $player, 'latest_videos' );
		$this->loader->add_action( 'wp_footer', $player, 'render_video' );
		$this->loader->add_filter( 'cron_schedules', $admin, 'add_schedules' );
		$this->loader->add_action( 'import_videos_recurring', $admin, 'import_videos', 10, 3 );
		$this->loader->add_filter( 'template_include', $admin, 'video_archive' );
	}

	public function run() {
		$this->loader->run();
	}
}
