<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class IsCallable extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
	    return is_callable($value);
	}

	public function getName()
	{
		return "callable";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label should be a callable";
	}
}