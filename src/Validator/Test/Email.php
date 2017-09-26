<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class Email extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		$value = $this->sanitize($value);

		return (filter_var($value, FILTER_VALIDATE_EMAIL) !== false);
	}

	public function sanitize($value)
	{
		return trim($value);
	}

	public function getName()
	{
		return "email";
	}

	public function getTranslation()
	{
		return array(
			"en_GB" => "Field __field__ is not a valid email"
		);
	}
}