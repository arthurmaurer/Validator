<?php
use PHPUnit\Framework\TestCase;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\ResultCollection;

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
					"luckyNumbers" => array(4, 12, 37)
				),
				"friends" => array(
					"noe" => array(
						"age" => 26,
					),
					"flo" => array(
						"age" => 31,
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
			array("unknown",				new NoResult()),
			array("user.unknown",			new NoResult()),
			array("unknown.name",			new NoResult()),
			array("user.name",				$data["user"]["name"]),
			array("user.adress.city",		$data["user"]["adress"]["city"]),
			array("user.adress.street",		new NoResult()),
			array("user.luckyNumbers",		$data["user"]["luckyNumbers"]),
			array("user.luckyNumbers.*",	new ResultCollection($data["user"]["luckyNumbers"])),
			array("friends.*.age",			new ResultCollection(array("noe" => 26, "flo" => 31))),
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