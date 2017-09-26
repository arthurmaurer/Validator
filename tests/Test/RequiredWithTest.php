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
			array(new NoResult,		"firstname",	new NoResult,	false),
			array(new NoResult,		"unknown",		new NoResult,	true),

			array("value",			"firstname",	new NoResult,	true),
			array("value",			"unknown",		new NoResult,	true),

			array(new NoResult,		"firstname",	"Arthur",		false),
			array(new NoResult,		"firstname",	"Bob",			true),

			array("value",			"firstname",	"Arthur",		true),
			array("value",			"firstname",	"Bob",			true),
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

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}