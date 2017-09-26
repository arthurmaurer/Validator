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
			array(null,			false),
			array("",			false),
			array("abcd",		true),
			array(" ",			false),
			array("abcd0",		false),
			array("1",			false),
			array(1,			false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testAlpha($value, $expected)
	{
		$test = new Alpha;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}