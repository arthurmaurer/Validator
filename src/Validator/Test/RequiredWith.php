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

		// echo "\n";
		// var_dump(array(
		// 	"pair" => $pair,
		// 	"pairValue" => $pairValue
		// ));

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

	public function getTranslation()
	{
		return array(
			"en_GB" => "Field __field__ is required"
		);
	}
}