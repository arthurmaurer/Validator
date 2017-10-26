<?php
namespace Validator;

class TestFactory
{
	public function create($params)
	{
		$name = $params[0];

		if (!isset(Validator::$testClasses[$name]))
			throw new \Exception("Test $name is not registered");

		$class = Validator::$testClasses[$name];

		// We pop the name
		array_shift($params);

		$test = new $class($params);

		return $test;
	}

	public function bulkCreate(array $params)
	{
		$tests = array();

		foreach ($params as $row)
			$tests[] = $this->create($row);

		return $tests;
	}
}