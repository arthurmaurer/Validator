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
			array(new NoResult,	Test::RESULT_VALID),
			array(0,			Test::RESULT_VALID),
			array(5,			Test::RESULT_VALID),
			array(6,			Test::RESULT_ERROR),
			array("",			Test::RESULT_VALID),
			array("abcde",		Test::RESULT_VALID),
			array("abcdef",		Test::RESULT_ERROR),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testMax($value, $expected)
	{
		$test = new Max(array(5));

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}