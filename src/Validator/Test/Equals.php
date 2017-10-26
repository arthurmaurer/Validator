<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Equals extends Test
{
	const PARAM_WANTED_VALUE = 0;
	const PARAM_STRICT_CMP = 1;

	public function test($value, Field $field, DataMapper $dataMapper)
	{
		if (isset($this->params[self::PARAM_STRICT_CMP]) && $this->params[self::PARAM_STRICT_CMP])
			return ($value === $this->params[self::PARAM_WANTED_VALUE]);
		else
			return ($value == $this->params[self::PARAM_WANTED_VALUE]);
	}

	public function getName()
	{
		return "equals";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must be equal to ". $this->params[self::PARAM_WANTED_VALUE];
	}
}