<?php

namespace CroissantPoll;

class CustomFields {

	public function register_poll_fields() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		$key = 'poll_';

		\acf_add_local_field_group(
			[
				'key'      => $key . 'group',
				'title'    => 'Poll Information',
				'fields'   => [
					[
						'key'        => $key . 'awswers',
						'label'      => 'Poll answer list (please do not reorder them once the poll is published)',
						'name'       => $key . 'answers',
						'type'       => 'repeater',
						'sub_fields' => [
							[
								'key'   => $key . 'text',
								'label' => 'Answers for the poll (please do not reorder them once the poll is published)',
								'name'  => $key . 'text',
								'type'  => 'text',
							],
						],
					],
					[
						'key'   => $key . 'date_limit',
						'label' => 'Date limit for this poll',
						'name'  => $key . 'date_limit',
						'type'  => 'date_time_picker',
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'poll',
						],
					],
				],
			]
		);
	}

	public function register_article_fields( array $post_types ) {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		$locations = $this->set_locations( $post_types );
		$key       = 'article_poll';

		\acf_add_local_field_group(
			[
				'key'                   => $key . '_group',
				'title'                 => 'Poll',
				'fields'                => [
					[
						'key'       => 'article_has_poll',
						'name'      => 'article_has_poll',
						'label'     => 'Post contains a poll?',
						'type'      => 'true_false',
						'placement' => 'left',
					],
					[
						'key'               => $key,
						'name'              => $key,
						'label'             => 'Select a Poll',
						'type'              => 'post_object',
						'post_type'         => 'poll',
						'placement'         => 'left',
						'conditional_logic' => [
							[
								[
									'field'    => 'article_has_poll',
									'operator' => '==',
									'value'    => '1',
								],
							],
						],
					],
				],
				'location'              => $locations,
				'menu_order'            => 3,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
			]
		);
	}

	public function load_filters() {
		add_filter( 'acf/fields/post_object/query/name=article_poll', [ $this, 'query_polls' ] );
	}

	public function query_polls( $args ) {
		$args['post_status'] = 'publish';
		$args['meta_query']  = [
			[
				'key'     => 'poll_date_limit',
				'value'   => current_time( 'mysql' ),
				'compare' => '>',
				'type'    => 'DATE',
			],
		];

		return $args;
	}

	private function set_locations( array $post_types ) {
		$locations = [];
		foreach ( $post_types as $post_type ) {
			$locations[] = [
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => $post_type,
				],
			];
		}

		return $locations;
	}
}
