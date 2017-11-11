<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Date extends Test
{
	const PARAM_FORMAT = 0;

	public function test($value, Field $field, DataMapper $mapper)
	{
		$format = $this->params[self::PARAM_FORMAT];
		$date = \DateTime::createFromFormat($format, $value);

		if (!$date)
			return false;

		$dateString = $date->format($format);

		return ($dateString && $dateString === $value);
	}

	public function getName()
	{
		return "date";
	}

	public function translate(Field $field, $error, $locale)
	{
		return "$field->label is not a valid date";
	}
}