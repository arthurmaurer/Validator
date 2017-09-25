<?php
namespace Validator;
use Validator\TestFactory;

class FieldFactory
{
	public function create($fieldName, array $tests)
	{
		$field = new Field($fieldName);

		$testFactory = new TestFactory;
		$field->tests = $testFactory->bulkCreate($tests);

		return $field;
	}

	public function bulkCreate(array $fieldsData)
	{
		$fields = array();

		foreach ($fieldsData as $fieldName => $tests)
			$fields[$fieldName] = $this->create($fieldName, $tests);

		return $fields;
	}
}