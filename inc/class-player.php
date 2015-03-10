<?php

class YT_Player {
	
	protected $options;
	protected $video_info;
	
	public function __construct() {
		$this->options = array();
		$this->video_info = array();
	}
	
	public function get_options() {
		$this->options['post_id']			= get_the_ID();
		$this->options['video'] 			= get_post_meta( $this->options['post_id'] , 'ytc_video', true );
		$this->options['title'] 			= get_post_meta( $this->options['post_id'] , 'ytc_title', true );
		$this->options['description']		= get_post_meta( $this->options['post_id'] , 'ytc_description', true );
		$this->options['channel']			= get_post_meta( $this->options['post_id'] , 'ytc_channel', true );
		$this->options['definition']		= get_post_meta( $this->options['post_id'] , 'ytc_definition', true );
		$this->options['publish_date']		= get_post_meta( $this->options['post_id'] , 'ytc_publish_date', true );
		$this->options['time']				= get_post_meta( $this->options['post_id'] , 'ytc_time', true );
		$this->options['seconds']			= get_post_meta( $this->options['post_id'] , 'ytc_seconds', true );
		$this->options['start']				= ( get_post_meta( $this->options['post_id'] , 'ytc_start', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_start', true )			: 0 );
		$this->options['end']				= ( get_post_meta( $this->options['post_id'] , 'ytc_end', true ) != ''				? get_post_meta( $this->options['post_id'] , 'ytc_end', true )				: $this->options['seconds'] );
		$this->options['width'] 			= ( get_post_meta( $this->options['post_id'] , 'ytc_width', true ) 	!= ''			? get_post_meta( $this->options['post_id'] , 'ytc_width', true ) 			: get_option('ytc_width', 100) );
		$this->options['width_value']		= ( get_post_meta( $this->options['post_id'] , 'ytc_width_value', true ) != ''		? get_post_meta( $this->options['post_id'] , 'ytc_value', true ) 			: get_option('ytc_width_value', '%') );
		$this->options['width_ratio']		= ( get_post_meta( $this->options['post_id'] , 'ytc_width_ratio', true ) != ''		? get_post_meta( $this->options['post_id'] , 'ytc_width_ratio', true ) 		: get_option('ytc_width_ratio', 0) );
		$this->options['autoplay']			= ( get_post_meta( $this->options['post_id'] , 'ytc_autoplay', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_autoplay', true ) 		: get_option('ytc_autoplay', 0) );
		$this->options['volume']			= ( get_post_meta( $this->options['post_id'] , 'ytc_volume', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_volume', true ) 			: get_option('ytc_volume', 100) );
		$this->options['suggestedquality']	= ( get_post_meta( $this->options['post_id'] , 'ytc_suggestedquality', true )!= '' 	? get_post_meta( $this->options['post_id'] , 'ytc_suggestedquality', true ) : get_option('ytc_suggestedquality', 'default') );
		$this->options['controls']			= ( get_post_meta( $this->options['post_id'] , 'ytc_controls', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_controls', true ) 		: get_option('ytc_controls', 0) );
		$this->options['showinfo']			= ( get_post_meta( $this->options['post_id'] , 'ytc_showinfo', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_showinfo', true ) 		: get_option('ytc_showinfo', 1) );
		$this->options['autohide']			= ( get_post_meta( $this->options['post_id'] , 'ytc_autohide', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_autohide', true ) 		: get_option('ytc_autohide', 2) );
		$this->options['theme']				= ( get_post_meta( $this->options['post_id'] , 'ytc_theme', true ) 	!= ''			? get_post_meta( $this->options['post_id'] , 'ytc_theme', true ) 			: get_option('ytc_theme', 'dark') );
		$this->options['color']				= ( get_post_meta( $this->options['post_id'] , 'ytc_color', true ) 	!= ''			? get_post_meta( $this->options['post_id'] , 'ytc_color', true ) 			: get_option('ytc_color', 'red') );
		$this->options['modestbranding']	= ( get_post_meta( $this->options['post_id'] , 'ytc_modestbranding', true )	!= ''	? get_post_meta( $this->options['post_id'] , 'ytc_modestbranding', true ) 	: get_option('ytc_modestbranding', 0) );
		$this->options['iv_load_policy']	= ( get_post_meta( $this->options['post_id'] , 'ytc_iv_load_policy', true ) != ''	? get_post_meta( $this->options['post_id'] , 'ytc_iv_load_policy', true ) 	: get_option('ytc_iv_load_policy', 1) );
		$this->options['loop']				= ( get_post_meta( $this->options['post_id'] , 'ytc_loop', true ) != '' 			? get_post_meta( $this->options['post_id'] , 'ytc_loop', true ) 			: get_option('ytc_loop', 0) );
		$this->options['playbackrate']		= ( get_post_meta( $this->options['post_id'] , 'ytc_playbackrate', true ) != ''		? get_post_meta( $this->options['post_id'] , 'ytc_playbackrate', true ) 	: get_option('ytc_playbackrate', 1) );
		$this->options['rel']				= ( get_post_meta( $this->options['post_id'] , 'ytc_rel', true ) != ''				? get_post_meta( $this->options['post_id'] , 'ytc_rel', true ) 				: get_option('ytc_rel', 1) );
		$this->options['disableclick']		= ( get_post_meta( $this->options['post_id'] , 'ytc_disableclick', true ) != ''		? get_post_meta( $this->options['post_id'] , 'ytc_disableclick', true ) 	: get_option('ytc_disableclick', 0) );
		$this->options['version']			= ( get_post_meta( $this->options['post_id'] , 'ytc_version', true ) != ''			? get_post_meta( $this->options['post_id'] , 'ytc_version', true ) 			: get_option('ytc_version', 1.0) );
		return $this->options;
	}
}
