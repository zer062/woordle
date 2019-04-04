<?php
return [
	'key' => 'group_5ca612ffb8d97',
	'title' => __('Category course form', 'woordle'),
	'fields' => array(
		array(
			'key' => 'field_5ca61324ae9ca',
			'label' => __('Migrate this category to Moodle?', 'woordle'),
			'name' => 'woordle_migrate_category_moodle',
			'type' => 'true_false',
			'instructions' => __('Selecting this like yes, this category will migrated to Moodle like a course category', 'woordle'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'category-course',
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
];