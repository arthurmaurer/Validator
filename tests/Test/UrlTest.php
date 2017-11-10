<?php
use PHPUnit\Framework\TestCase;
use Validator\Test;
use Validator\Test\Url;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\Field;

class UrlTest extends TestCase
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
			array("http://example.com",	true),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testUrl($value, $expected)
	{
		$test = new Url;

		$result = $test->test($value, $this->field, $this->mapper);
		$this->assertEquals($expected, $result);
	}
}