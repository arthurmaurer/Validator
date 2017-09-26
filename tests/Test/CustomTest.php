<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Custom;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class CustomTest extends TestCase
{
	protected $field;
	protected $mapper;

	public function setUp()
	{
		$this->field = new Field("");
		$this->mapper = new DataMapper(array());
	}

	public function returnFalse($value, Field $field, DataMapper $mapper)
	{
		return false;
	}

	public function returnTrue($value, Field $field, DataMapper $mapper)
	{
		return true;
	}

	public function checkIf3($value, Field $field, DataMapper $mapper)
	{
		return ($value === 3);
	}

	public function getData()
	{
		return array(
			// 	  value		callback						expected
			array(1,		array($this, "returnTrue"),		true),
			array(1,		array($this, "returnFalse"),	false),
			array(3,		array($this, "checkIf3"),		true),
			array(1,		array($this, "checkIf3"),		false),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testCustom($value, $callback, $expected)
	{
		$test = new Custom(array($callback));

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}