<?php

class YT_Customizr {

	protected $loader;
	protected $plugin_slug;
	protected $screen;

	public function __construct() {
		$this->plugin_slug = 'youtube-customizr';
			
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
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $admin, 'settings' );
		$this->loader->add_action( 'init', $admin, 'video_post_type' );
		$this->loader->add_action( 'init', $this, 'language' );
		$this->loader->add_action( 'add_meta_boxes', $admin, 'video_meta_boxes' );
		$this->loader->add_action( 'save_post', $admin, 'update_settings' );
		$this->loader->add_filter( 'enter_title_here', $admin, 'change_title' );
	}

	public function run() {
		$this->loader->run();
	}
}
