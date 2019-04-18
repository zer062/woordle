<?php
/**
 * @package Woordle
 * @version 0.0.1
 */
/*
Plugin Name: Woordle
Plugin URI: https://zero62.com
Description: Wordle is the best online school management system for WordPress
Author: Zero62 Dev team
Version: 0.3.0
Author URI: https://zero62.com
Text Domain: woordle
*/

require 'core/autoload.php';

acf_add_local_field_group([
	'key' => 'woordle_course_settings_group',
	'title' => 'Course Details',
	'fields' => [],
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'courses',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
]);

acf_add_local_field_group([
	'key' => 'woordle_course_settings_groups',
	'title' => 'Course Details',
	'fields' => [],
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'courses',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
]);