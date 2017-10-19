<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Slug;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class SlugTest extends TestCase
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
			array("abcd0",		true),
			array("_abc-123_",	true),
			array("-abc-",		true),
			array("123",		true),
			array(123,			true),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testSlug($value, $expected)
	{
		$test = new Slug;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}