<?php

$key = 'widget_poll';
$widgetplacement = self::$config['tab_placement'];
$post_types = self::$config['post_types'];

$widget_config = [
	'key' => $key,
	'name' => 'poll',
	'label' => 'Poll',
	'display' => 'block',
	'sub_fields' => [
		[
			'key' => $key . '_basic_details_tab',
			'label' => 'Basic Details',
			'type' => 'tab',
			'placement' => $widgetplacement,
		],
		[
			'key'               => $key,
			'name'              => $key,
			'label'             => 'Select a Poll',
			'type'              => 'post_object',
			'post_type'         => 'poll',
		],
		[
			'key' => $key . '_advanced_details_tab',
			'label' => 'Advanced Details',
			'type' => 'tab',
			'placement' => $widgetplacement,
		]
	],
];
$widget_config["content-types"] = get_option("options_" . $key . "_available_post_types");
$widget_config["content-sizes"] = array('main'); // main, main-full-bleed, sidebar
