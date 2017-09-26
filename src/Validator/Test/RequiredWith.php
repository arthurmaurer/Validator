<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class RequiredWith extends Test
{
	const PARAM_FIELD = 0;
	const PARAM_FIELD_VALUE = 1;

	public function test($value, Field $field, DataMapper $dataMapper)
	{
		$pair = $this->params[self::PARAM_FIELD];
		$pairValue = $dataMapper->get($pair);

		if (isset($this->params[self::PARAM_FIELD_VALUE]))
		{
			$wantedValue = $this->params[self::PARAM_FIELD_VALUE];

			if ($wantedValue === $pairValue)
				return (!$value instanceof NoResult);

			return true;
		}

		return ($pairValue instanceof NoResult || !$value instanceof NoResult);
	}

	public function getName()
	{
		return "requiredWith";
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