<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Number;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class NumberTest extends TestCase
{
	protected $field;
	protected $mapper;

	public function setUp()
	{
		$this->field = new Field("");
		$this->mapper = new DataMapper(array());
	}

	public function getData()
	{
		return array(
			array(null,			false),
			array("",			false),
			array("11",			true),
			array("11.11",		true),
			array("11a",		false),
			array("11.11a",		false),
			array("11.",		true),
			array(".11",		true),
			array("-11.11",		true),
			array("-.11",		true),
			array("a",			false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testNumber($value, $expected)
	{
		$test = new Number;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}