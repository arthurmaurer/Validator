<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Number extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return (is_numeric($value));
	}

	public function getName()
	{
		return "number";
	}

	public function getTranslation()
	{
		return array(
			"en_GB" => "Field __field__ must be a number"
		);
	}
}