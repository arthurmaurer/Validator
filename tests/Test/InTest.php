<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\In;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class InTest extends TestCase
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
			array("one",		Test::RESULT_VALID),
			array(2,			Test::RESULT_ERROR),
			array(null,			Test::RESULT_ERROR),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testIn($value, $expected)
	{
		$test = new In(array(
			array("one", "two", 3)
		));

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}