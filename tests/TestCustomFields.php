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

	public function test_register() {
		Functions\expect('acf_add_local_field_group')
			->once()
			->with(Mockery::any());
		Patchwork\redefine('function_exists', Patchwork\always(true));

		$obj = new CustomFields();
		$obj->register();
	}

	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}
