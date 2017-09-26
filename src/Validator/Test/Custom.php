<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Custom extends Test
{
	const PARAM_TEST = 0;
	const PARAM_TRANS = 0;

	public function test($value, Field $field, DataMapper $mapper)
	{
		$test = $this->params[self::PARAM_TEST];

		return $test($value, $field, $mapper);
	}

	public function getName()
	{
		return "custom";
	}

	public function translate(Field $field, $error, $locale)
	{
		if (isset($this->params[self::PARAM_TRANS]))
			return $this->params[self::PARAM_TRANS]($field, $error, $locale);

		return "$field->label is invalid";
	}
}