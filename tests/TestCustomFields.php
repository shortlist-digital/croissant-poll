<?php

use CroissantPoll\CustomFields;
use Brain\Monkey;
use Brain\Monkey\Functions;

class TestCustomFields extends PHPUnit_Framework_TestCase
{
	protected function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	public function test_register_poll_fields() {
		Functions\expect('acf_add_local_field_group')
			->once()
			->with(Mockery::any());
		Patchwork\redefine('function_exists', Patchwork\always(true));

		$obj = new CustomFields();
		$obj->register_poll_fields();
	}

	public function test_load_filters() {
		$obj = new CustomFields();
		$obj->load_filters();

		$this->assertTrue(has_filter('acf/fields/post_object/query/name=widget_poll', [$obj, 'query_polls']));
		$this->assertTrue(has_filter('acf/update_value/name=poll_date_limit', [$obj, 'add_fake_date']));
		$this->assertTrue(has_filter('acf/load_value/name=poll_date_limit', [$obj, 'empty_if_fake_date']));
	}

	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}
