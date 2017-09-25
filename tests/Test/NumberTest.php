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
			array(new NoResult,	Test::RESULT_VALID),
			array(null,			Test::RESULT_VALID),
			array("",			Test::RESULT_VALID),
			array("11",			Test::RESULT_VALID),
			array("11.11",		Test::RESULT_VALID),
			array("11a",		Test::RESULT_ERROR),
			array("11.11a",		Test::RESULT_ERROR),
			array("11.",		Test::RESULT_VALID),
			array(".11",		Test::RESULT_VALID),
			array("-11.11",		Test::RESULT_VALID),
			array("-.11",		Test::RESULT_VALID),
			array("a",			Test::RESULT_ERROR),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testNumber($value, $expected)
	{
		$test = new Number;

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}