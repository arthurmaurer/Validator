<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Equals;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class EqualsTest extends TestCase
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
			array(null,		null,		false,		true),
			array("0",		false,		false,		true),
			array("0",		false,		true,		false),
			array("abc",	"abc",		false,		true),
			array("abc",	"abc",		true,		true),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testAlpha($value, $wantedValue, $strictComparison, $expected)
	{
		$test = new Equals(array(
			$wantedValue,
			$strictComparison,
		));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}