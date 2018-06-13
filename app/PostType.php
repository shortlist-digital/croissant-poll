<?php

namespace CroissantPoll;

class PostType {

	public function init() {
		add_action( 'init', [ $this, 'register' ] );
	}

	public function register() {

		$labels = [
			'name'               => 'Polls',
			'singular_name'      => 'Poll',
			'add_new_item'       => 'Add New Poll',
			'edit_item'          => 'Edit Poll',
			'new_item'           => 'New Poll',
			'search_items'       => 'Search Poll',
			'not_found'          => 'No polls found.',
			'not_found_in_trash' => 'No polls found in Trash.',
			'all_items'          => 'All Polls',
		];

		register_post_type(
			'poll', [
				'public'    => false,
				'show_ui'   => true,
				'labels'    => $labels,
				'supports'  => [
					'title',
				],
				'menu_icon' => 'dashicons-welcome-write-blog',
			]
		);
	}
}
