<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class RequiredWith extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		$pair = $this->params[0];
		$pairValue = $dataMapper->get($pair);

		if (isset($this->params[1]))
		{
			$wantedValue = $this->params[1];

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