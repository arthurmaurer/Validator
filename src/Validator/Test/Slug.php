<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Slug extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return preg_match("#^[a-z0-9_-]+$#i", $value);
	}

	public function getName()
	{
		return "slug";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must contain only non-accented letters, digits and \"-\" and \"_\" symbols";
	}
}