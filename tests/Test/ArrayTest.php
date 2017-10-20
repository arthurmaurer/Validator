<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\IsArray;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class ArrayTest extends TestCase
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
			array("abcd",		false),
			array(1,			false),
			array(array(),		true),
			array(array(1, 2),	true),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testArray($value, $expected)
	{
		$test = new IsArray;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}