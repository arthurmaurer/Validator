<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class IsArray extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return is_array($value);
	}

	public function getName()
	{
		return "array";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must be an array";
	}
}