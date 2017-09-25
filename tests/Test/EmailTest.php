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
			array(new NoResult,			Test::RESULT_VALID),
			array(null,					Test::RESULT_VALID),
			array("",					Test::RESULT_VALID),
			array("test@test.te",		Test::RESULT_VALID),
			array("@test.test",			Test::RESULT_ERROR),
			array("t-__@test.tt",		Test::RESULT_VALID),
			array("test.test",			Test::RESULT_ERROR),
			array("test@test.",			Test::RESULT_ERROR),
			array("t est@test.te",		Test::RESULT_ERROR),
			array("test@t est.te",		Test::RESULT_ERROR),
			array("test@test.t e",		Test::RESULT_ERROR),
			array("  test@test.test  ",	Test::RESULT_VALID),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testEmail($value, $expected)
	{
		$test = new Email;

		$result = $test->testAndConvertResult($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}