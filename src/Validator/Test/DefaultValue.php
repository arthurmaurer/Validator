<?php
namespace Validator\Test;
use Validator\Test;
use Validator\Field;
use Validator\DataMapper\DataMapper;
use Validator\DataMapper\NoResult;

class DefaultValue extends Test
{
	const PARAM_DEFAULT_VALUE = 0;

	public function test($value, Field $field, DataMapper $mapper)
	{
	    return true;
	}

	public function sanitizeOutput($value)
	{
	    return ($value) ? $value : $this->params[self::PARAM_DEFAULT_VALUE];
	}

	public function getName()
	{
		return "default";
	}
}