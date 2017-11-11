<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Date;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class DateTest extends TestCase
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
			array("2009-02-15 15:16:17",	"Y-m-d H:i:s",	true),
			array("2009-02-15 15:16:17",	"Y-m-d H:i",	false),
			array("2009-02-15 15:16:17",	"b",			false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testDate($value, $format, $expected)
	{
		$test = new Date(array(
			$format
		));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}