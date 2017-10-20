<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Length extends Test
{
	const PARAM_LENGTH = 0;

	public function test($value, Field $field, DataMapper $dataMapper)
	{
		if (!is_array($value))
			return false;

		return (count($value) == $this->params[self::PARAM_LENGTH]);
	}

	public function getName()
	{
		return "length";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must be an array of ". $this->params[self::PARAM_LENGTH] ." element(s)";
	}
}