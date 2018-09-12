<?php

$container = new Pimple\Container();

$container['post_type'] = function($c) {
	return new CroissantPoll\PostType();
};

$container['custom_fields'] = function($c) {
	return new CroissantPoll\CustomFields();
};

$container['allowed_post_types'] = function($c) {
	return [
		'post',
		'longform',
		'sponsored_post',
		'sponsored_longform'
	];
};

return $container;
