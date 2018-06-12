<?php

namespace CroissantPoll;

class CustomFields {

	public function register() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		$key = 'polls_answers';

		\acf_add_local_field_group(
			[
				'key'      => $key . '_group',
				'title'    => 'Answers',
				'fields'   => [
					[
						'key'        => $key,
						'label'      => 'Publish this post to Apple News',
						'name'       => $key,
						'type'       => 'repeater',
						'sub_fields' => [
							[
								'key'   => $key . '_text',
								'label' => 'Answers for the poll',
								'name'  => $key . '_text',
								'type'  => 'text',
							],
						],
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
}
