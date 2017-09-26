<?php
namespace Validator;
use Validator\DataMapper\DataMapper;

abstract class Test
{
	const RESULT_VALID = 0;
	const RESULT_ERROR = -1;

	public $params = array();

	public function __construct(array $params = array())
	{
		$this->params = $params;
	}

	public function testAndConvertResult($value, Field $field, DataMapper $mapper)
	{
		$result = $this->test($value, $field, $mapper);

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

	public function shouldTestMissingFields()
	{
		return false;
	}

	public function translate(Field $field, $error, $locale)
	{
		return "";
	}

	public function sanitize($value)
	{
		return $value;
	}
}