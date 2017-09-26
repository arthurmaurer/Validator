<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Email;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class EmailTest extends TestCase
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
			array(null,					false),
			array("",					false),
			array("test@test.te",		true),
			array("@test.test",			false),
			array("t-__@test.tt",		true),
			array("test.test",			false),
			array("test@test.",			false),
			array("t est@test.te",		false),
			array("test@t est.te",		false),
			array("test@test.t e",		false),
			array("  test@test.test  ",	true),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testEmail($value, $expected)
	{
		$test = new Email;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}