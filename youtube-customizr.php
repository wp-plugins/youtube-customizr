<?php
/*
Plugin Name: Youtube Customizr
Plugin URI: http://www.dannyvanholten.com/youtube-customizr
Description: Add all kinds of functionality to the YouTube player trough it's API. Control the volume, hide the controls or just play a selected part of your video. The YouTube Customizr makes custom YouTube players accesible for every Wordpress user.
Author: DannyvanHolten
Version: 1.0
Author URI: http://www.dannyvanholten.com
License: GPL2

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'YTC_FILE' ) ) {
	define( 'YTC_FILE', __FILE__ );
}

if ( ! defined( 'YTC_PATH' ) ) {
	define( 'YTC_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YTC_URL' ) ) {
	define( 'YTC_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'YTC_BASE' ) ) {
	define( 'YTC_BASE', plugin_basename( dirname( __FILE__ ) ) );
}

require_once plugin_dir_path( YTC_FILE ) . 'inc/class-main.php';

function run_yt_customizr() {
	$spmm = new YT_Customizr();
	$spmm->run();
}

run_yt_customizr();