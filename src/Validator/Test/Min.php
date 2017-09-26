<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Min extends Test
{
	const PARAM_LIMIT = 0;
	const PARAM_STRICT = 1;

	public function test($value, Field $field, DataMapper $dataMapper)
	{
		if (!is_numeric($value))
			return false;

		$limit = $this->params[self::PARAM_LIMIT];

		if (isset($this->params[self::PARAM_STRICT]) && $this->params[self::PARAM_STRICT])
			return ($value > $limit);

		return ($value >= $limit);
	}

	public function getName()
	{
		return "min";
	}

	public function translate(Field $field, $error, $locale)
	{
		$orEqual = (isset($this->params[self::PARAM_STRICT]) && $this->params[self::PARAM_STRICT])
			? ""
			: " or equal";

		return "$field->label must be greater$orEqual than ". $this->params[self::PARAM_LIMIT];
	}
}