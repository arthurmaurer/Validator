<?php
use PHPUnit\Framework\TestCase;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;

class DataMapperTest extends TestCase
{
	protected static $data;
	protected $mapper;

	protected static function getMapperData()
	{
		if (!self::$data)
		{
			self::$data = array(
				"user" => array(
					"name" => "Arthur",
					"alias" => "morten",
					"age" => 25,
					"adress" => array(
						"city" => "Paris",
					),
					"particularities" => array(
						"ugly",
						"ugly af",
					),
				),
				"friends" => array(
					"noe" => array(
						"name" => "Noe",
					),
					"flo" => array(
						"name" => "Flo",
					),
				),
			);
		}

		return self::$data;
	}

	public function setUp()
	{
		$data = self::getMapperData();
		$this->mapper = new DataMapper($data);
	}

	public function getData()
	{
		$data = self::getMapperData();

		return array(
			array("unknown",			new NoResult()),
			array("user.unknown",		new NoResult()),
			array("unknown.name",		new NoResult()),
			array("user.name",			$data["user"]["name"]),
			array("user.adress.city",	$data["user"]["adress"]["city"]),
			array("user.adress.street",	new NoResult()),
		);
	}

	/**
	 * @dataProvider getData
	 */
	public function testMapper($path, $expected)
	{
		$result = $this->mapper->get($path);
		$this->assertEquals($expected, $result);
	}
}