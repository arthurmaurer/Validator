<?php
namespace Validator;
use Validator\DataMapper\DataMapper;
use Validator\Field;
use Validator\FieldFactory;
use Validator\ErrorContainer;

class Validator
{
	public static $testClasses = array();

	public $fields = array();
	public $errorContainer;
	public $labels = array();

	public static function addTest($testClass)
	{
		if (!class_exists($testClass))
			throw new \Exception("Test $testClass does not exist.");

		$test = new $testClass;
		$name = $test->getName();

		self::$testClasses[$name] = $testClass;

		Translator::addTranslation($test);
	}

	public function __construct(array $fields = null)
	{
		$this->errorContainer = new ErrorContainer;

		if ($fields)
			$this->addFields($fields);
	}

	public function addLabels(array $labels)
	{
		$this->labels += $labels;
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
		$dataMapper = new DataMapper($data);

		$this->errorContainer->clear();

		foreach ($this->fields as $field)
			$this->validateField($field, $dataMapper);

		return ($this->errorContainer->count() === 0);
	}

	public function validateField(Field $field, DataMapper $dataMapper)
	{
		foreach ($field->tests as $testName => $test)
		{
			$value = $dataMapper->get($field->name);

			$result = $test->testAndConvertResult($value, $field, $dataMapper);

			if ($result === Test::RESULT_ERROR)
				$this->addError($field, $test);

			if ($result === Test::RESULT_ERROR || $result === Test::RESULT_BREAK)
				return false;
		}

		return true;
	}

	public function addError(Field $field, Test $test)
	{
		$this->errorContainer->add(array(
			"field" => $field,
			"test" => $test
		));
	}
}

Validator::addTest('Validator\\Test\\Max');
Validator::addTest('Validator\\Test\\Number');
Validator::addTest('Validator\\Test\\Alpha');
Validator::addTest('Validator\\Test\\Required');
Validator::addTest('Validator\\Test\\RequiredWith');
Validator::addTest('Validator\\Test\\Email');
Validator::addTest('Validator\\Test\\In');