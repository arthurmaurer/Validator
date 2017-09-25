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
		if ($value instanceof NoResult)
			return true;

		$valueWithoutSpaces = str_replace(" ", "", $value);

		return ($valueWithoutSpaces === "" || ctype_alpha($valueWithoutSpaces));
	}

	public function getName()
	{
		return "alpha";
	}

	public function getTranslation()
	{
		return array(
			"en_GB" => "Field __field__ must contain only alphabetical characters"
		);
	}
}