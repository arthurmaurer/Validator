<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Length;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class LengthTest extends TestCase
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
			array(array(),			0,	true),
			array(array(1, 2, 3),	3,	true),
			array(array(1, 2),		3,	false),
			array(null,				0,	false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testLength($value, $length, $expected)
	{
		$test = new Length(array($length));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}