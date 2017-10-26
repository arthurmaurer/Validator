<?php
use PHPUnit\Framework\TestCase;
use Validator\Parser\ArrayShorthand;

class ArrayShorthandTest extends TestCase
{
	public function testValidParser()
	{
		$parser = new ArrayShorthand;

		$src = array(
			"age" => array(
				"required",
				array("min", 0),
			),
			"requiredValue" => "required",
		);

		$expected = array(
			"age" => array(
				array("required"),
				array("min", 0),
			),
			"requiredValue" => array(
				array("required"),
			),
		);

		$result = $parser->parseFields($src);
		$this->assertEquals($expected, $result);
	}

	public function testInvalidParser()
	{
		$parser = new ArrayShorthand;
		$src = array(
			"age" => array(
				"required",
				5,
				array("min", 0),
			),
		);

		$this->expectException(\Exception::class);
		$parser->parseFields($src);
	}

	public function testInvalidParser2()
	{
		$parser = new ArrayShorthand;
		$src = array(
			"age" => 5,
		);

		$this->expectException(\Exception::class);
		$parser->parseFields($src);
	}
}