<?php

use CroissantPoll\PostType;
use Brain\Monkey;
use Brain\Monkey\Functions;

class TestCroissantPoll extends PHPUnit_Framework_TestCase
{
	protected function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	public function test_init_method_is_working() {
		$obj = new PostType();
		$obj->init();

		$this->assertTrue(has_action('init', [$obj, 'register']));
	}

	public function test_register() {
		Functions\expect('register_post_type')
			->once()
			->with('poll', Mockery::any());

		$obj = new PostType();
		$obj->register();
	}

	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}
