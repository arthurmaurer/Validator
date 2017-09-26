<?php
namespace Validator;

class ValidatorWrapper
{
	public $v;

	public function __construct(array $fields = null)
	{
		$this->v = new Validator;

		if ($fields)
			$this->addFields($fields);
	}

	public function addLabels(array $labels)
	{
		foreach ($labels as $fieldPath => $label)
			$this->v->fields[$fieldPath]->label = $label;
	}

	public function addField($fieldName, array $tests)
	{
		$fieldFactory = new FieldFactory;

		$field = $fieldFactory->create($fieldName, $tests);
		$this->v->fields[$fieldName] = $field;
	}

	public function addFields(array $fields)
	{
		foreach ($fields as $fieldPath => $tests)
			$this->addField($fieldPath, $tests);
	}

	public function validate(array $data)
	{
		return $this->v->validate($data);
	}

	public function getErrors($locale = null)
	{
		$translator = new Translator;
		$errors = $translator->translateErrors($this->v->errors, $locale);

		return $errors;
	}
}