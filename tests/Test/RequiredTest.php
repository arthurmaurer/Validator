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
			array(new NoResult,	false),
			array(null,			true),
			array("",			true),
			array(0,			true),
			array(false,		true),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testRequired($value, $expected)
	{
		$test = new Required;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}