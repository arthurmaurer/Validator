<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class In extends Test
{
	const PARAM_ENUM = 0;

	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return (in_array($value, $this->params[self::PARAM_ENUM]));
	}

	public function getName()
	{
		return "in";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label is incorrect";
	}
}