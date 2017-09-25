<?php
namespace Validator;
use Validator\DataMapper\DataMapper;

abstract class Test
{
	// The test succeeds, we go to the next test
	const RESULT_VALID = 0;
	// The test fails, we stop here and we throw an error
	const RESULT_ERROR = -1;
	// We stop here without throwing an error
	const RESULT_BREAK = -2;

	public $params = array();

	public function __construct(array $params = array())
	{
		$this->params = $params;
	}

	public function testAndConvertResult($value, Field $field, DataMapper $data)
	{
		$result = $this->test($value, $field, $data);

		if ($result === true)
			$result = self::RESULT_VALID;
		else if ($result === false)
			$result = self::RESULT_ERROR;

		return $result;
	}

	public function getName()
	{
		throw new \Exception("Test::getName field must be overridden.");
	}

	public function getTranslation()
	{
		return array();
	}

	public function sanitize($value)
	{
		return $value;
	}
}