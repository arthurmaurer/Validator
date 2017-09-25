<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Required;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class RequiredTest extends TestCase
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
			array(new NoResult,	Test::RESULT_ERROR),
			array(null,			Test::RESULT_VALID),
			array("",			Test::RESULT_VALID),
			array(0,			Test::RESULT_VALID),
			array(false,		Test::RESULT_VALID),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testRequired($value, $expected)
	{
		$test = new Required;

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}