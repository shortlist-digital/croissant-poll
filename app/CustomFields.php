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
						'required'   => 1,
						'min'        => 2,
						'max'        => 6,
						'sub_fields' => [
							[
								'key'       => $key . 'text',
								'label'     => 'Answers for the poll (please do not reorder them once the poll is published)',
								'name'      => $key . 'text',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 40,
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

	public function load_filters() {
		add_filter( 'acf/fields/post_object/query/name=widget_poll', [ $this, 'query_polls' ] );
		add_filter( 'acf/update_value/name=poll_date_limit', [ $this, 'add_fake_date' ] );
		add_filter( 'acf/load_value/name=poll_date_limit', [ $this, 'empty_if_fake_date' ] );
	}

	public function query_polls( $args ) {
		$args['post_status'] = 'publish';
		$args['orderby']     = 'date';
		$args['order']       = 'DESC';
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

	public function add_fake_date( $value ) {
		if ( empty( $value ) ) {
			$value = '2080-12-31 23:59:59';
		}

		return $value;
	}

	public function empty_if_fake_date( $value ) {
		if ( $value === '2080-12-31 23:59:59' ) {
			return '';
		}

		return $value;
	}
}
