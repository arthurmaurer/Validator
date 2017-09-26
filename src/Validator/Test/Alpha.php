<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Alpha extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		$valueWithoutSpaces = str_replace(" ", "", $value);

		return (ctype_alpha($valueWithoutSpaces));
	}

	public function getName()
	{
		return "alpha";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must contain only alphabetical characters";
	}
}