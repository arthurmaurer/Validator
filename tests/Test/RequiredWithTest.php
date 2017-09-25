<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\RequiredWith;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class RequiredWithTest extends TestCase
{
	protected $field;
	protected $mapper;

	public function setUp()
	{
		$this->field = new Field("");
		$this->mapper = new DataMapper(array(
			"firstname" => "Arthur",
			"lastname" => "Maurer",
			"age" => 25
		));
	}

	public function getData()
	{
		return array(
			array(new NoResult,		"firstname",	new NoResult,	Test::RESULT_ERROR),
			array(new NoResult,		"unknown",		new NoResult,	Test::RESULT_VALID),

			array("value",			"firstname",	new NoResult,	Test::RESULT_VALID),
			array("value",			"unknown",		new NoResult,	Test::RESULT_VALID),

			array(new NoResult,		"firstname",	"Arthur",		Test::RESULT_ERROR),
			array(new NoResult,		"firstname",	"Bob",			Test::RESULT_VALID),

			array("value",			"firstname",	"Arthur",		Test::RESULT_VALID),
			array("value",			"firstname",	"Bob",			Test::RESULT_VALID),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testRequiredWith($value, $targetField, $wantedValue, $expected)
	{
		$params = array($targetField);

		if (!$wantedValue instanceof NoResult)
			$params[] = $wantedValue;

		$test = new RequiredWith($params);

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}