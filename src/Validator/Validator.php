<?php
namespace Validator;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;
use Validator\DataMapper\ResultCollection;

class Validator
{
	public static $testClasses = array();

	public $fields = array();
	public $errors;
	public $sanitizedData;

	public static function addTest($testClass)
	{
		if (!class_exists($testClass))
			throw new \Exception("Test $testClass does not exist.");

		$test = new $testClass;
		$names = $test->getName();

		if (!is_array($names)) {
		    $names = [$names];
        }

		foreach ($names as $name) {
		    self::$testClasses[$name] = $testClass;
        }
	}

	public function validate(array $data)
	{
		$mapper = new DataMapper($data);

		$this->errors = array();

		foreach ($this->fields as $field)
		{
			$value = $mapper->get($field->name);

			// If a wildcard has been used
			if ($value instanceof ResultCollection)
			{
				foreach ($value->results as $k => $v)
					$this->validateField($v, $field, $mapper);
			}
			else
				$result = $this->validateField($value, $field, $mapper);
		}

		$this->sanitizedData = $mapper->data;

		return (count($this->errors) === 0);
	}

	public function validateField($value, Field $field, DataMapper $mapper)
	{
		foreach ($field->tests as $test)
		{
			if ($value instanceof NoResult && !$test->shouldTestMissingFields())
				continue ;

			$result = $test->testAndConvertResult($value, $field, $mapper);

			if ($result !== Test::RESULT_VALID)
			{
				$this->addError($field, $test, $result);
				return false;
			}

			$value = $this->sanitizeFieldOutput($value, $test, $field, $mapper);
		}

		return true;
	}

	public function sanitizeFieldOutput($value, Test $test, Field $field, DataMapper $mapper)
	{
		$sanitizedValue = $test->sanitizeOutput($value);
		$mapper->set($field->name, $sanitizedValue);

		return $sanitizedValue;
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
Validator::addTest('Validator\\Test\\Custom');
Validator::addTest('Validator\\Test\\IsArray');
Validator::addTest('Validator\\Test\\Length');
Validator::addTest('Validator\\Test\\Equals');
Validator::addTest('Validator\\Test\\Url');
Validator::addTest('Validator\\Test\\Date');
Validator::addTest('Validator\\Test\\IsCallable');
Validator::addTest('Validator\\Test\\DefaultValue');
Validator::addTest('Validator\\Test\\Integer');
Validator::addTest('Validator\\Test\\Boolean');