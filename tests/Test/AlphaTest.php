<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Alpha;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class AlphaTest extends TestCase
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
			array("abcd",		Test::RESULT_VALID),
			array(" ",			Test::RESULT_VALID),
			array("abcd0",		Test::RESULT_ERROR),
			array("1",			Test::RESULT_ERROR),
			array(1,			Test::RESULT_ERROR),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testAlpha($value, $expected)
	{
		$test = new Alpha;

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}