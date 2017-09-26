<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class In extends Test
{
	public function test($value, Field $field, DataMapper $dataMapper)
	{
		return (in_array($value, $this->params[0]));
	}

	public function getName()
	{
		return "in";
	}

	public function getTranslation()
	{
		return array(
			"en_GB" => "Field __field__ is incorrect"
		);
	}
}