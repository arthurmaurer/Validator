<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Integer extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return (is_integer($value) || ctype_digit($value));
	}

    public function sanitizeOutput($value)
    {
        return (int)$value;
    }

    public function getName()
	{
		return ["integer", "int"];
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label must be an integer";
	}
}