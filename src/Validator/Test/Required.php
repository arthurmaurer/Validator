<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Required extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return (!$value instanceof NoResult && $value !== "" && $value !== null);
	}

	public function getName()
	{
		return "required";
	}

	public function shouldTestMissingFields()
	{
		return true;
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label is required";
	}
}