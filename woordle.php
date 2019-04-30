<?php
if (! defined ('ABSPATH') ) exit;
/**
 * @package Woordle
 * @version 0.0.1
 */
/*
Plugin Name: Woordle
Plugin URI: https://zero62.com
Description: Wordle is the best online school management system for WordPress
Author: Zero62 Dev team
Version: 0.9.1
Author URI: https://zero62.com
Text Domain: woordle
*/

require 'core/autoload.php';
new Woordle();
function woordle_enable_plugin() {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'woordle_enable_plugin' );