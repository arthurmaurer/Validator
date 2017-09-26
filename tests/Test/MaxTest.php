<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Max;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class MaxTest extends TestCase
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
			array(0,			true),
			array(5,			true),
			array(6,			false),
			array("",			false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testMax($value, $expected)
	{
		$test = new Max(array(5));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}