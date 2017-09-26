<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Min;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class MinTest extends TestCase
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
			//	  value	limit	strict	expected
			array(8,	5,		false,	true),
			array(5,	5,		false,	true),
			array(5,	5,		true,	false),
			array(4,	5,		false,	false),
			array("",	5,		false,	false),
			array("ab",	5,		false,	false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testMin($value, $limit, $strict, $expected)
	{
		$test = new Min(array($limit, $strict));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}