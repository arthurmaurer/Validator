<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Max;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class MaxTest extends TestCase
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
			//	  value				limit						exclusive	expected
			array(0,				5,							false,		true),
			array(5,				5,							false,		true),
			array(5,				5,							true,		false),
			array(6,				5,							false,		false),
			array("",				5,							false,		false),
			array("ab",				5,							false,		false),
			array(new \DateTime,	new \DateTime,				false,		true),
			array(new \DateTime,	new \DateTime,				true,		false),
			array(new \DateTime,	new \DateTime("+1 day"),	false,		true),
			array(new \DateTime,	new \DateTime("-1 day"),	false,		false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testMax($value, $limit, $exclusive, $expected)
	{
		$test = new Max(array($limit, $exclusive));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}