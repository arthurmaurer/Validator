<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Max extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		if (!is_numeric($value))
			return false;

		return ($value <= $this->params[0]);
	}

	public function getName()
	{
		return "max";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must be lower than ". $this->params[0];
	}
}