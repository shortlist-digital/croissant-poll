<?php

$container = new Pimple\Container();

$container['post_type'] = function($c) {
	return new CroissantPoll\PostType();
};

$container['custom_fields'] = function($c) {
	return new CroissantPoll\CustomFields();
};

return $container;
