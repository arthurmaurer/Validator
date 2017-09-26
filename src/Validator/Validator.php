<?php
namespace Validator;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;
use Validator\Field;
use Validator\FieldFactory;
use Validator\ErrorContainer;

class Validator
{
	public static $testClasses = array();

	public $fields = array();
	public $errorContainer;

	public static function addTest($testClass)
	{
		if (!class_exists($testClass))
			throw new \Exception("Test $testClass does not exist.");

		$test = new $testClass;
		$name = $test->getName();

		self::$testClasses[$name] = $testClass;
	}

	public function __construct(array $fields = null)
	{
		$this->errorContainer = new ErrorContainer;

		if ($fields)
			$this->addFields($fields);
	}

	public function addLabels(array $labels)
	{
		foreach ($labels as $fieldPath => $label)
			$this->fields[$fieldPath]->label = $label;
	}

	public function addField($fieldName, array $tests)
	{
		$fieldFactory = new FieldFactory;

		$field = $fieldFactory->create($fieldName, $tests);
		$this->fields[$fieldName] = $field;
	}

	public function addFields(array $fields)
	{
		$fieldFactory = new FieldFactory;

		$this->fields += $fieldFactory->bulkCreate($fields);
	}

	public function validate(array $data)
	{
		$mapper = new DataMapper($data);

		$this->errorContainer->clear();

		foreach ($this->fields as $field)
			$this->validateField($field, $mapper);

		return ($this->errorContainer->count() === 0);
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
		$this->errorContainer->add(array(
			"field" => $field,
			"test" => $test,
			"error" => $error
		));
	}

	public function getErrors()
	{
		return $this->errorContainer->errors;
	}
}

Validator::addTest('Validator\\Test\\Max');
Validator::addTest('Validator\\Test\\Number');
Validator::addTest('Validator\\Test\\Alpha');
Validator::addTest('Validator\\Test\\Required');
Validator::addTest('Validator\\Test\\RequiredWith');
Validator::addTest('Validator\\Test\\Email');
Validator::addTest('Validator\\Test\\In');