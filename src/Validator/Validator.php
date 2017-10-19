<?php
namespace Validator;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Validator
{
	public static $testClasses = array();

	public $fields = array();
	public $errors;

	public static function addTest($testClass)
	{
		if (!class_exists($testClass))
			throw new \Exception("Test $testClass does not exist.");

		$test = new $testClass;
		$name = $test->getName();

		self::$testClasses[$name] = $testClass;
	}

	public function validate(array $data)
	{
		$mapper = new DataMapper($data);

		$this->errors = array();

		foreach ($this->fields as $field)
			$this->validateField($field, $mapper);

		return (count($this->errors) === 0);
	}

	public function validateField(Field $field, DataMapper $mapper)
	{
		$value = $mapper->get($field->name);

		foreach ($field->tests as $testName => $test)
		{
			if ($value instanceof NoResult && !$test->shouldTestMissingFields())
				continue ;

			$result = $test->testAndConvertResult($value, $field, $mapper);

			if ($result !== Test::RESULT_VALID)
			{
				$this->addError($field, $test, $result);
				return false;
			}
		}

		return true;
	}

	public function addError(Field $field, Test $test, $error)
	{
		$this->errors[] = array(
			"field" => $field,
			"test" => $test,
			"error" => $error
		);
	}
}

Validator::addTest('Validator\\Test\\Max');
Validator::addTest('Validator\\Test\\Min');
Validator::addTest('Validator\\Test\\Number');
Validator::addTest('Validator\\Test\\Alpha');
Validator::addTest('Validator\\Test\\Required');
Validator::addTest('Validator\\Test\\RequiredWith');
Validator::addTest('Validator\\Test\\Email');
Validator::addTest('Validator\\Test\\In');
Validator::addTest('Validator\\Test\\Slug');